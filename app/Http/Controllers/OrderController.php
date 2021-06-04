<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function manage() {
        if (Gate::allows('admin', Auth::user())) {
            return view('manage');
        } else {
            return redirect()->route('main');
        }
    }

    public function received() {
        if (Gate::allows('admin', Auth::user())) {

            $receivedOrders = Order::where('status','RECEIVED')->get();

            return view('manage-received',compact('receivedOrders'));
        } else {
            return redirect()->route('main');
        }
    }

    public function order($id) {
        if (Gate::allows('admin', Auth::user())) {
            $order = Order::find($id);
            if($order != null) {
                if(count(Order::find($id)->where('status','RECEIVED')->get()) == 0) {
                    return redirect()->route('manage.received');
                }
            }

            return view('order',compact('order'));
        } else {
            return redirect()->route('main');
        }
    }

    public function processedOrder($id) {
        if (Gate::allows('admin', Auth::user())) {
            $order = Order::find($id);

            if($order != null) {
                if(count(Order::find($id)->where('status','ACCEPTED')->orWhere('status','REJECTED')->get()) == 0) {
                    return redirect()->route('manage.received');
                }
            }

            return view('order',compact('order'));
        } else {
            return redirect()->route('main');
        }
    }

    public function accept($orderId) {
        if (Gate::allows('admin', Auth::user())) {

            $foundOrder = Order::find($orderId);
            $foundOrder->status = 'ACCEPTED';
            $currtime = Carbon::now();
            $foundOrder->processed_on = $currtime;
            $foundOrder->save();

            return redirect()->route('manage')->with('accepted',true);
        } else {
            return redirect()->route('main');
        }
    }

    public function reject($orderId) {
        if (Gate::allows('admin', Auth::user())) {
            $order = Order::find($orderId);
            $order->status = 'REJECTED';
            $currtime = Carbon::now();
            $order->processed_on = $currtime;
            $order->save();
            return redirect()->route('manage')->with('rejected',true);
        } else {
            return redirect()->route('main');
        }
    }

    public function processed() {
        if (Gate::allows('admin', Auth::user())) {
            $receivedOrders = Order::where('status','ACCEPTED')->orWhere('status','REJECTED')->get();
            return view('manage-processed',compact('receivedOrders'));
        } else {
            return redirect()->route('main');
        }
    }
}
