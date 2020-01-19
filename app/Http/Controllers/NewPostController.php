<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Book_post;

class NewPostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    //
    public function show(){
        return view('newpost');
    }

    public function input(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' =>'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publishing_date'=> 'date|required',
            'price' => 'numeric|required|min:0',
            'condition' => ['required',Rule::in(['very good', 'good', 'ok', 'worn', 'bad'])],
            'description' => 'required|string|min:10|max:1000',
            'image' => 'nullable|image|max:1024',
            'captcha' => 'required|captcha'
        ]);
        $path='default.png';
        if ($request->file('image')){
            $path = Auth::id() . '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public',$path);
        }
        $post = new Book_post;
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->author=$request->author;
        $post->publisher=$request->publisher;
        $post->publishing_date=$request->publishing_date;
        $post->condition = $request->condition;
        $post->description = $request->description;
        $post->price = $request->price;
        $post->image=$path;
        $post->save();
        return redirect('profile');
    }
}
