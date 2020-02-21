<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\OrderPost;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }


    public function show(){
        $u_id = Auth::id();
        $posts = DB::table('book_posts')->where('user_id','=',$u_id)->latest()->paginate(12);
        $addresses = DB::table('shipping_address')->where('user_id','=',$u_id)->oldest()->get();
        $purchases = Order::where('user_id',$u_id)->get();
        return view('profile', ['posts'=>$posts,'addresses'=>$addresses,'purchases'=>$purchases])->render();
    }
}
