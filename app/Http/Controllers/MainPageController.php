<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MainPageController extends Controller
{

    public function show(){
        $user_id=-1;
        if (Auth::id()){
            $user_id=Auth::id();
        }
        $posts = DB::table('book_posts')->where('state', '=', 'accepted')->where('user_id','<>',$user_id)->oldest()->paginate(4);
        return view('main',['posts'=>$posts]);
    }
}
