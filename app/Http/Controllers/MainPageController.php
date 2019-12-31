<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainPageController extends Controller
{
    public function show(){
        $posts = DB::table('book_posts')->where('state', '=', 'accepted')->oldest()->paginate(12);
        return view('main',['posts'=>$posts]);
    }
}
