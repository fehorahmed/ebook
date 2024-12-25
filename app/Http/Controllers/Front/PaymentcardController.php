<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\UserCard;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Customer;
use Stripe\PaymentMethod;
use Stripe\Stripe;
use Stripe\Token;

class PaymentcardController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }

    public function index()
    {
        if (is_null($this->user) || !$this->user->hasRole('customer')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        return view('frontend.payment.index');
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->hasRole('customer')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        return view('frontend.payment.create');
    }

    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasRole('customer')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            if(!$this->user->stripe_customer_id){
                $customer = Customer::create([
                    'payment_method' => $request->stripe_payment_method_id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'description' => 'Website customer',
                ]);
            }
            $stripe_customer_id = null;
            if($this->user->stripe_customer_id){
                $stripe_customer_id = $this->user->stripe_customer_id;
            }else{
                $stripe_customer_id = $customer->id;
            }
            

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $stripe->paymentMethods->attach(
                $request->stripe_payment_method_id,
                ['customer' => $stripe_customer_id]
            );

            UserCard::create([
                'user_id' => $this->user->id,
                'stripe_payment_method_id' => $request->stripe_payment_method_id,
                'card_type' => $request->card_type,
                'card_holder_name' => $this->user->name,
                'card_number' => $request->card_number,
                'exp_month' => $request->exp_month,
                'exp_year' => $request->exp_year,
                'status' => 'active',
            ]);

            $this->user->update(
                [
                    'stripe_customer_id' => $stripe_customer_id,
                    'payment_method_status' => 'active',
                ]
            );
            
            return response()->json(['success' => true, 'message' => 'Subscribed successfully!'], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 200);
        }
    }

    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->hasRole('customer')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $card = UserCard::find($id);
        if (is_null($card)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('paymentsetups.index');
        }
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $stripe->paymentMethods->detach(
                $card->stripe_payment_method_id,
                []
            );
            $this->user->update(
                [
                    'payment_method_status' => 'inactive',
                ]
            );
            $card->delete();
            session()->flash('success', 'Card has been deleted permanently !!');
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        
    }

    public function __store(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasRole('customer')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $validatedData = $request->validate([
            'card_number' => 'required|string|regex:/[0-9]{16}/', // Assuming a 16-digit card number
            'exp_month' => 'required|digits_between:1,2|min:1|max:12', // Expiry month should be between 1 and 12
            'exp_year' => 'required|digits:4|numeric|min:' . date('Y'), // Expiry year should be current year or later
            'cvc' => 'required|string|regex:/[0-9]{3,4}/', // Assuming 3 or 4 digit cvc
        ]);
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $token = Token::create([
                'card' => [
                    'number' => $validatedData['card_number'],
                    'exp_month' => $validatedData['exp_month'],
                    'exp_year' => $validatedData['exp_year'],
                    'cvc' => $validatedData['cvc'],
                ],
            ]);

            // $paymentMethod = PaymentMethod::create([
            //     'type' => 'card',
            //     'card' => [
            //         'number' => $validatedData['card_number'],
            //         'exp_month' => $validatedData['exp_month'],
            //         'exp_year' => $validatedData['exp_year'],
            //         'cvc' => $validatedData['cvc'],
            //     ],
            // ]);
            dd($token);

            $customer = Customer::create([
                'payment_method' => $paymentMethod->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'description' => 'Website customer',
            ]);

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $stripe->paymentMethods->attach(
                $paymentMethod->id,
                ['customer' => $customer->id]
            );

            UserCard::create([
                'user_id' => $this->user->id,
                'stripe_payment_method_id' => $paymentMethod->id,
                'card_type' => $paymentMethod->card ? $paymentMethod->card->brand : 'card',
                'card_holder_name' => $this->user->name,
                'card_number' => $validatedData['card_number'],
                'card_cvc' => $validatedData['cvc'],
                'exp_month' => $validatedData['exp_month'],
                'exp_year' => $validatedData['exp_year'],
                'status' => 'active',
            ]);

            $this->user->update(
                [
                    'stripe_customer_id' => $customer->id,
                    'payment_method_status' => 'active',
                ]
            );
            
            session()->flash('success', 'Payment method has been created successfully !!');
            return redirect()->route('paymentsetups.index');
        } catch (Exception $e) {
            session()->flash('error', 'Payment failed: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
