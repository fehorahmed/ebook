<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\SubscribeRequest;
use App\Models\User;
use Illuminate\Http\Request;

class SubscribeRequestController extends Controller
{
    public function orderIndex(){
        $orders = Order::orderBy('id', 'desc')->get();
        return view('backend.dashboard.admin.sub_req.subscribe_request', compact('orders'));
    }

    public function SubscribeValidate(Request $request){
       $request->validate([
            'email' => 'required|string|email|unique:subscribe_requests'
       ]);
        $sub_request = new Order();
        $sub_request->email = $request->email;
        $sub_request->save();
        return response()->json(['success' => true, 'message' => 'Subscribed successfully!'], 200);
    }

    public function orderShow($id){
        $order = Order::find($id);
        return view('backend.dashboard.admin.order.show', compact('order'));
    }
}
