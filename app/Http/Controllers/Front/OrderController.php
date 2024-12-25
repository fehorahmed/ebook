<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PricingSetting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Validator;

class OrderController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasRole('customer')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $orders = Order::where('user_id', $this->user->id)->whereIn('order_status', ['accepted', 'delivered', 'canceled'])->orderBy('id', 'desc')->get();
        if(count($orders) > 0){
            return view('frontend.orders.index', compact('orders'));
        }else{
            return redirect()->route('orders.create');
        }
    }


    public function create()
    {
        if (is_null($this->user) || !$this->user->hasRole('customer')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $pricing = PricingSetting::first();
        $orders = Order::where('user_id', $this->user->id)
                  ->whereIn('order_status', ['accepted', 'delivered', 'canceled'])
                  ->get();
        return view('frontend.orders.create', compact('pricing', 'orders'));
    }

    // sa
    public function createbackup()
    {
        if (is_null($this->user) || !$this->user->hasRole('customer')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $pricing = PricingSetting::first();
        return view('frontend.orders.createbackup', compact('pricing'));
    }
    // sa

    public function validateForm(Request $request)
    {
        $rules = [
            'video_type' => 'required|string|in:basic,pro-animation,youtube,corporate',
            'number_of_videos' => 'required|numeric|min:1',
            'first_video_duration' => 'required',
            'second_video_duration' => 'nullable|required_if:number_of_videos,2|required_if:number_of_videos,3',
            'third_video_duration' => 'nullable|required_if:number_of_videos,3',
            'requirements' => 'required',
            'raw_data_link' => 'nullable',
            'no_data' => 'required|in:0,1',
            'fast_delivery' => 'required|in:0,1'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasRole('customer')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        try {
            DB::beginTransaction();
            $pricing = PricingSetting::first();
            $subtotal = 0;
            if ($pricing) {
                $subtotal = $this->generate_sub_total($request, $pricing);
            }
            $fast_delivery_price = 0;
            if (isset($request->fast_delivery) && $request->fast_delivery == 'on') {
                $fast_delivery_price = $pricing->fast_delivery_price;
            }

            $all_order = Order::withTrashed()->count();
            $order_number = 'WB-' . str_pad($all_order + 1, 5, '0', STR_PAD_LEFT);

            $order = Order::create([
                'user_id' => $this->user->id,
                'user_name' => $this->user->name,
                'user_email' => $this->user->email,
                'order_number' => $order_number,
                'video_type' => $request->video_type,
                'number_of_videos' => $request->number_of_videos,
                'first_video_duration' => $request->first_video_duration ?? 0,
                'second_video_duration' => $request->second_video_duration ?? 0,
                'third_video_duration' => $request->third_video_duration ?? 0,
                'requirements' => $request->requirements,
                'raw_data_link' => $request->raw_data_link ?? null,
                'no_data' => isset($request->no_data) && $request->no_data == 'on' ? 1 : 0,
                'fast_delivery' => isset($request->fast_delivery) && $request->fast_delivery == 'on' ? 1 : 0,
                'fast_delivery_charge' => $fast_delivery_price,
                'subtotal' => number_format($subtotal, 2, '.'),
                'discount' => 0,
                'total' => number_format(($subtotal + $fast_delivery_price), 2, '.'),
                'payment_status' => 'pending',
                'order_status' => 'init',
                'order_init_at' => now(),
            ]);
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $charge = PaymentIntent::create([
                'amount' => $order->total * 100,
                'currency' => 'usd',
                'customer' => $this->user->stripe_customer_id,
                'payment_method' => $this->user->card->stripe_payment_method_id,
                'confirm' => true,
                'return_url' => route('order_confirm')
            ]);
            if (isset($charge['status']) &&  $charge['status'] == 'succeeded') {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'transaction_code' => $charge['id'], //payment intent id
                    'transaction_date' => now(),
                    'currency' => 'usd',
                    'stripe_customer_id' => $charge['customer'], // customer id
                    'latest_charge' => $charge['latest_charge'],
                    'payment_method' => $charge['payment_method'],
                ]);
                $order->update([
                    'payment_status' => 'accepted',
                    'order_status' => 'accepted',
                    'order_accepted_at' => now(),
                ]);
            } else {
                session()->flash('error', 'Charge has been failed, please try again.');
            }
            if(env('MAIL_ENABLED')){
                Mail::to($this->user)->send(new OrderConfirmationMail($order->order_number));
            }
            DB::commit();
            session()->flash('success', 'Order has been placed successfully !!');
            return redirect()->route('orders.index');
        } catch (Exception $ex) {
            DB::rollBack();
            session()->flash('error', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function orderConfirm(Request $request){
        return redirect()->route('orders.index');
    }

    public function __store(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasRole('customer')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        try {
            DB::beginTransaction();
            $pricing = PricingSetting::first();
            $subtotal = 0;
            if ($pricing) {
                $subtotal = $this->generate_sub_total($request, $pricing);
            }
            $fast_delivery_price = 0;
            if (isset($request->fast_delivery) && $request->fast_delivery == 'on') {
                $fast_delivery_price = $pricing->fast_delivery_price;
            }

            $all_order = Order::withTrashed()->count();
            $order_number = 'WB-' . str_pad($all_order + 1, 5, '0', STR_PAD_LEFT);

            $order = Order::create([
                'user_id' => $this->user->id,
                'user_name' => $this->user->name,
                'user_email' => $this->user->email,
                'order_number' => $order_number,
                'video_type' => $request->video_type,
                'number_of_videos' => $request->number_of_videos,
                'first_video_duration' => $request->first_video_duration ?? 0,
                'second_video_duration' => $request->second_video_duration ?? 0,
                'third_video_duration' => $request->third_video_duration ?? 0,
                'requirements' => $request->requirements,
                'raw_data_link' => $request->raw_data_link ?? null,
                'no_data' => isset($request->no_data) && $request->no_data == 'on' ? 1 : 0,
                'fast_delivery' => isset($request->fast_delivery) && $request->fast_delivery == 'on' ? 1 : 0,
                'fast_delivery_charge' => $fast_delivery_price,
                'subtotal' => number_format($subtotal, 2, '.'),
                'discount' => 0,
                'total' => number_format(($subtotal + $fast_delivery_price), 2, '.'),
                'payment_status' => 'pending',
                'order_status' => 'init',
                'order_init_at' => now(),
            ]);
            DB::commit();
            return view('frontend.orders.stripe_checkout', compact('order'));
        } catch (Exception $ex) {
            DB::rollBack();
            session()->flash('error', $ex->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->hasRole('customer')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $user = User::find($id);
        if (is_null($user)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('users.index');
        }
        return view('backend.dashboard.admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->hasRole('customer')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $order = Order::find($id);
        $cardholder_name = $request->cardholder_name;

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripeToken = $request->stripeToken;
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $customer = $this->createStripeCustomer($this->user, $stripe, $stripeToken, $cardholder_name, $order->order_number);

        try {
            DB::beginTransaction();
            $charge = \Stripe\Charge::create(array(
                "amount" => $order->total * 100,
                "currency" => "usd",
                "customer" => $customer->id
            ));
            if (isset($charge['status']) &&  $charge['status'] == 'succeeded') {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'transaction_code' => $charge['id'],
                    'transaction_date' => now(),
                    'currency' => 'usd',
                    'stripe_card_id' => isset($charge['source']) ? $charge['source']['id'] : '',
                    'card_type' => isset($charge['source']) ? $charge['source']['brand'] : '',
                    'card_holder_name' => $cardholder_name,
                    'card_number' => isset($charge['source']) ? $charge['source']['last4'] : '',
                    'card_cvc' => isset($charge['source']) ? $charge['source']['cvc_check'] : '',
                    'card_expiry_month' => isset($charge['source']) ? $charge['source']['exp_month'] : '',
                    'card_expiry_year' => isset($charge['source']) ? $charge['source']['exp_year'] : '',
                    'payment_mod' => isset($charge['source']) ? $charge['source']['object'] : '',
                    'payment_type' => "One time",
                ]);
                $order->update([
                    'payment_status' => 'accepted',
                    'order_status' => 'accepted',
                    'order_accepted_at' => now(),
                ]);
                DB::commit();
                session()->flash('success', 'Order has been placed successfully !!');
                return view('frontend.orders.thankyou', compact('order'));
            } else {
                session()->flash('error', 'Charge has been failed, please try again.');
                // return redirect()->route('orders.index');
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', $ex->getMessage());
            // return redirect()->route('orders.index');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_null($this->user) || !$this->user->hasRole('customer')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $order = Order::where('user_id', $this->user->id)->whereIn('order_status', ['accepted', 'delivered', 'canceled'])->find($id);
        if (is_null($order)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('orders.index');
        }
        return view('frontend.orders.show', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->hasRole('customer')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $user = User::find($id);
        if (is_null($user)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('users.index');
        }
        if ($user->avatar) {
            UploadHelper::deleteFile('upload/avatar_images/' . $user->avatar);
        }
        $user->delete();

        session()->flash('success', 'User has been deleted permanently !!');
        return redirect()->back();
    }

    private function generate_sub_total($request, $pricing)
    {
        $subtotal = 0;
        if ($request->video_type == 'basic') {
            if ($request->number_of_videos == 1) {
                $subtotal += $pricing->basic_video_per_minute_price * $request->first_video_duration;
            }
            if ($request->number_of_videos == 2) {
                $subtotal += $pricing->basic_video_per_minute_price * $request->first_video_duration;
                $subtotal += $pricing->basic_video_per_minute_price * $request->second_video_duration;
            }
            if ($request->number_of_videos == 3) {
                $subtotal += $pricing->basic_video_per_minute_price * $request->first_video_duration;
                $subtotal += $pricing->basic_video_per_minute_price * $request->second_video_duration;
                $subtotal += $pricing->basic_video_per_minute_price * $request->third_video_duration;
            }
            return $subtotal;
        }
        if ($request->video_type == 'pro-animation') {
            if ($request->number_of_videos == 1) {
                $subtotal += $pricing->pro_animation_video_per_minute_price * $request->first_video_duration;
            }
            if ($request->number_of_videos == 2) {
                $subtotal += $pricing->pro_animation_video_per_minute_price * $request->first_video_duration;
                $subtotal += $pricing->pro_animation_video_per_minute_price * $request->second_video_duration;
            }
            if ($request->number_of_videos == 3) {
                $subtotal += $pricing->pro_animation_video_per_minute_price * $request->first_video_duration;
                $subtotal += $pricing->pro_animation_video_per_minute_price * $request->second_video_duration;
                $subtotal += $pricing->pro_animation_video_per_minute_price * $request->third_video_duration;
            }
            return $subtotal;
        }
        if ($request->video_type == 'youtube') {
            if ($request->number_of_videos == 1) {
                $subtotal += $pricing->youtube_video_per_minute_price * $request->first_video_duration;
            }
            if ($request->number_of_videos == 2) {
                $subtotal += $pricing->youtube_video_per_minute_price * $request->first_video_duration;
                $subtotal += $pricing->youtube_video_per_minute_price * $request->second_video_duration;
            }
            if ($request->number_of_videos == 3) {
                $subtotal += $pricing->youtube_video_per_minute_price * $request->first_video_duration;
                $subtotal += $pricing->youtube_video_per_minute_price * $request->second_video_duration;
                $subtotal += $pricing->youtube_video_per_minute_price * $request->third_video_duration;
            }
            return $subtotal;
        }
        if ($request->video_type == 'corporate') {
            if ($request->number_of_videos == 1) {
                $subtotal += $pricing->corporate_video_per_minute_price * $request->first_video_duration;
            }
            if ($request->number_of_videos == 2) {
                $subtotal += $pricing->corporate_video_per_minute_price * $request->first_video_duration;
                $subtotal += $pricing->corporate_video_per_minute_price * $request->second_video_duration;
            }
            if ($request->number_of_videos == 3) {
                $subtotal += $pricing->corporate_video_per_minute_price * $request->first_video_duration;
                $subtotal += $pricing->corporate_video_per_minute_price * $request->second_video_duration;
                $subtotal += $pricing->corporate_video_per_minute_price * $request->third_video_duration;
            }
            return $subtotal;
        }
        return $subtotal;
    }

    private function createStripeCustomer($user, $stripe, $token, $cardholder_name, $order_number)
    {
        $customer = null;
        if ($user->stripe_customer_id != null) {
            $customer = $stripe->customers->retrieve($user->stripe_customer_id);
        }
        if ($customer == null) {
            $customer = $stripe->customers->create(
                [
                    'email' => $user->email,
                    'name' => $cardholder_name,
                    'description' => 'Website customer',
                    "source" => $token,
                ]
            );
        }

        $user->update(
            [
                'stripe_customer_id' => $customer->id
            ]
        );

        return $customer;
    }
}
