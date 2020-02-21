<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book_post;
use App\Shipping_address;
use Illuminate\Support\Facades\Auth;
use App\Order;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function show()
    {
        return view('cart');
    }
    public function cart(Request $request)
    {
        $response = [];
        if(isset($request->cart)){
            $cart_array = json_decode($request->cart);
            foreach ($cart_array as $id) {
                $response[] = Book_post::where('id', '=', $id)->where('state', '=', 'accepted')->firstOrFail();
            }
            return response(json_encode($response));
        }
        if(isset($request->checkout)){
            $request->session()->put('checkout',$request->checkout);
            return response('');
        }
    }
    public function showcheckout(Request $request){
        $cart = $request->session()->get('checkout',null);
        $cartitems=[];
        $price=0;
        if (empty($cart)){
            return redirect('cart');
        }
        else{
            $cart=json_decode($cart);
        }
        foreach ($cart as $id) {
            $item = Book_post::where('id', '=', $id)->firstOrFail();
            $price +=  $item->price;
            $cartitems[]=$item;
        }
        $addresses = Shipping_address::where('user_id',Auth::id())->get();
        return view('checkout',['addresses'=>$addresses,'cartitems'=>$cartitems,'price'=>$price]);
    }
   public function checkout(Request $request){
        $cart = $request->session()->get('checkout', null);
        $cartitems = [];
        $price = 0;
        $order = new Order;
        if (empty($cart)) {
            return redirect('cart');
        } else {
            $cart = json_decode($cart);
        }
        foreach ($cart as $id) {
            $item = Book_post::where('id', '=', $id)->firstOrFail();
            $price +=  $item->price;
            $item->update(['state'=>'sold']);
            $cartitems[] = $item;
        }
        $order->user_id=Auth::id();
        $order->time= date('Y-m-d H:i:s');
        $order->price = $price;
        $order->address_id=$request->shipping_address;
        $order->save();
        foreach($cartitems as $item){
            $order->add_to_order($item->id,$item->price);
        }
        return redirect('profile');
   }
}
