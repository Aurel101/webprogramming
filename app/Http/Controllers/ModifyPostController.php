<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Book_post;

class ModifyPostController extends Controller
{
    private $user_id=null;
    private $post = null;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

    }

    public function show(string $id)
    {
        $this->user_id=Auth::id();
        if (!ctype_digit($id)) {
            return redirect($to = '/' . $id);
        }
        $this->post = Book_post::whereRaw('user_id = ? AND id = ? AND (state = ? OR state = ? )',[$this->user_id,$id,'rejected','pending'])->firstOrFail();
        if(isset($this->post)){
            return view('modifypost',['post'=>$this->post]);
        }
    }

    public function modify(string $id,Request $request){
        if (!ctype_digit($id)) {
            return redirect($to = '/' . $id);
        }
        $post = Book_post::find($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publishing_date' => 'date|required',
            'price' => 'numeric|required|min:0',
            'condition' => ['required', Rule::in(['very good', 'good', 'ok', 'worn', 'bad'])],
            'description' => 'required|string|min:10|max:1000',
            'image' => 'nullable|image|max:1024',
            'captcha' => 'required|captcha'
        ]);
        $path = $post->image;
        if ($request->file('image')) {
            $request->file('image')->storeAs('public', $path);
        }
        DB::table('book_posts')->where('id',$id)->update(['title'=>$request->title,'author'=>$request->author,
        'publisher'=>$request->publisher,'publishing_date'=>$request->publishing_date,
        'condition'=>$request->condition,'description'=>$request->description,
        'price'=>$request->price,'image'=>$path,'state'=>'pending']);
        return redirect('profile');
    }

    public function delete(string $id){
        $this->user_id = Auth::id();
        if (!ctype_digit($id)) {
            return redirect($to = '/' . $id);
        }
        $post = Book_post::whereRaw('user_id = ? AND id = ? AND (state = ? OR state = ? )', [$this->user_id, $id, 'rejected', 'pending'])->firstOrFail();
        $post->delete();
        return redirect('profile');
    }
}
