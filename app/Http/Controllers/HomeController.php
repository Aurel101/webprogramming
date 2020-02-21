<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request)
    {
        $user_id=-1;
        $posts=null;
        if (Auth::id()){
            $user_id=Auth::id();
        }
        if(empty($request->search)){
            $posts=DB::table('book_posts')->where('state','=','accepted')->where('user_id','<>',$user_id)->oldest()->paginate(12);
        }
        else{
            $posts=DB::table('book_posts')->whereRaw('(user_id != ?) and (state = ?) AND ((author like ?) or (title like ?) or (publisher like ?) or (publishing_date like ?))',[$user_id,'accepted','%'.$request->search.'%', '%' . $request->search . '%', '%' . $request->search . '%', '%' . $request->search . '%'])->oldest()->paginate(12);
        }
        return view('home',['posts'=>$posts]);
    }
}
