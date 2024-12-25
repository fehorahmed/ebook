<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\DeliveryLinknConfirmationMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('user')->whereIn('order_status', ['accepted', 'delivered', 'canceled'])->orderBy('id', 'desc')->get();
        return view('backend.dashboard.admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::whereIn('order_status', ['accepted', 'delivered', 'canceled'])->find($id);
        if (is_null($order)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('order.index');
        }
        return view('backend.dashboard.admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function orderDelivery($id, Request $request)
    {
        $order = Order::where('order_status', 'accepted')->find($id);
        if (is_null($order)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('order.index');
        }
        $order->update([
            'order_delivered_at' => now(),
            'order_status' => 'delivered',
            'delivery_link' => $request->delivery_link,
        ]);
        if(env('MAIL_ENABLED')){
            Mail::to($order->user->email)->send(new DeliveryLinknConfirmationMail($request->delivery_link));
        }
        session()->flash('success', 'Order has been delivered successfully !!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::where('order_status', 'accepted')->find($id);
        if (is_null($order)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('order.index');
        }

        try {
            DB::beginTransaction();
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $refund = $stripe->refunds->create([
                'charge' => $order->order_details->latest_charge,
            ]);
            if (isset($refund['status']) &&  $refund['status'] == 'succeeded') {
                $order->update([
                    'stripe_refund_id' => $refund['id'],
                    'order_canceled_at' => now(),
                    'order_status' => 'canceled',
                ]);
            }
            DB::commit();
            session()->flash('success', 'Order canceled and refunded successfully !!');
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', $ex->getMessage());
        }
    }
}
