<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book_post;

class PostsController extends Controller
{
    //
    public function show(int $id){
        $post=Book_post::where('id','=',$id)->where('state','=','accepted')->firstOrFail();
        return view('postdisplay',['post'=>$post]);
    }
}
