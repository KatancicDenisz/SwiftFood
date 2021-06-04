<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Http\Controllers\Input;
use Illuminate\Support\Facades\DB;
use App\Models\OrderedItem;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use function Symfony\Component\String\b;

class MainController extends Controller
{

    public function index() {
        $item_count = Item::count();
        $user_count = User::count();
        $category_count = Category::count();
        return view('main',compact('item_count','user_count','category_count'));
    }

    public function showAbout()
    {
        return view('about');
    }

    public function getCategory($id)
    {
        $category_id = Category::find($id);
        $categories = Category::all();
        return view('menu', compact('category_id', 'categories'));
    }

    public function showMenu()
    {
        $items = Item::all();
        $categories = Category::all();
        $category_id = 'all';
        return view('menu', compact('items', 'categories','category_id'));
    }
    public function showProfile()
    {
        return view('profile');
    }
    public function getRemove()
    {
        return redirect()->route('cart');
    }
    public function showOrders()
    {
        if(Auth::user()) {
            if(count($orders = Order::where(function ($query) {
                $query->where('user_id',Auth::user()->id)
                    ->where('status','RECEIVED');
            })->orWhere(function($query) {
                $query->where('user_id',Auth::user()->id)
                    ->where('status','ACCEPTED');
            })->get()) == null) {
                $orders = null;
            } else {
                $orders = Order::where(function ($query) {
                    $query->where('user_id',Auth::user()->id)
                        ->where('status','RECEIVED');
                })->orWhere(function($query) {
                    $query->where('user_id',Auth::user()->id)
                        ->where('status','ACCEPTED');
                })->get();
            }
        }

        //TODO melyik ordereket jelenitsük meg?

        return view('orders',compact('orders'));
    }
    public function showCart()
    {
        if(Order::where('user_id',Auth::user()->id)->first() == null) {
            $orders = null;
        } else {
            if(count(Order::where('user_id',Auth::user()->id)->where('status','CART')->get()) != 0) {
                $orders_tmp = Order::where('user_id',Auth::user()->id)->where('status','CART')->get();
                $orders = $orders_tmp[0];
            } else {
                $orders = null;
            }
        }
        return view('cart', compact('orders'));
    }

    public function add(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'quantity' => 'integer|between:1,10|required',
        ]);


        if ($validator->fails()) {
            return redirect()->route('cart')
                ->withErrors($validator);
        } else {

            $quantity = $request->get('quantity');
            $item_id = $request->get('item_id');

            $isCart = Order::where('status', 'CART')->where('user_id',Auth::user()->id)->first();
            $id_where_cart_exits = null;
            if($isCart == null) {
                $order = Order::create([
                    'user_id' => Auth::user()->id,
                    'status' => 'CART'
                ]);
                $id_where_cart_exits = $order->id;
            } else {
                $id_where_cart_exits = $isCart->id;
            }

            //Ordereditem hozzáadása az adazbázishoz
            if (OrderedItem::where('item_id', $item_id)->where('order_id',$id_where_cart_exits)->first() == null) {
                OrderedItem::create([
                    'item_id' => $item_id,
                    'order_id' => $id_where_cart_exits,
                    'quantity' => $quantity,
                ]);
            } else {
                //Ha már benne van az adatbázisban, akkor növeljük a quantityt
                $updateQuantity =  OrderedItem::where('item_id', $item_id)->where('order_id',$id_where_cart_exits)->first();
                $updateQuantity->quantity =  $updateQuantity->quantity + $quantity;

                $updateQuantity->save();
            }

            //Megkeressük azt az ordert, amelyik a jelenlegi userhez tartozik és a statusa CART
            if(Order::where('user_id',Auth::user()->id)->where('status','CART')->first() == null) {
                $orders = null;
            } else {
                $orders_tmp = Order::where('user_id',Auth::user()->id)->where('status','CART')->get();
                $orders = $orders_tmp[0];
            }
            return redirect()->route('cart')->with('orders', $orders);
        }
    }
    public function remove(Request $request)
    {
        $itemId = $request->get('itemId');

        OrderedItem::find($itemId)->delete();
        //$orders = Order::where('user_id',Auth::user()->id)->where('status','CART')->first();

        $ordered_items = OrderedItem::all();
        return redirect()->route('cart')->with('ordered_items', $ordered_items);
    }

    public function send(Request $request) {

        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'payment_method' => 'required',
        ]);

        if( Order::where('user_id',Auth::user()->id)->where('status','CART')->first() != null) {
            if(count(Order::where('user_id',Auth::user()->id)->where('status','CART')->first()->ordereditems) == 0) {
                return redirect()->route('cart')->with('emptyCart', true);
            }
        } else {
            return redirect()->route('cart')->with('emptyCart', true);
        }

        if ($validator->fails())
        {
            return redirect()->route('cart')->withErrors($validator, 'orderErrors');
        }

        $address = $request->get('address');
        $payment_method = $request->get('payment_method');
        $comments = $request->get('comments');

        //TODO
        //hozzáadni az AB-hoz
        $updatedOrder = Order::where('user_id',Auth::user()->id)->where('status','CART')->first();
        $updatedOrder->status = 'RECEIVED';
        $updatedOrder->address = "" . $address;
        $updatedOrder->comment =  "" . $comments;
        $updatedOrder->payment_method = $payment_method;
        $currtime = Carbon::now();
        $updatedOrder->received_on = $currtime;
        $updatedOrder->save();

        return redirect()->route('orders')->with('ordedSuccess', true);
    }
}

