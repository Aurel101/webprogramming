<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book_post;

class CompareController extends Controller
{
    public function show(){
       return view('compare');
    }
    public function compare(Request $request){
        $response=[];
        $compare_array=json_decode($request->compare);
        foreach ($compare_array as $id) {
            $response[] = Book_post::where('id', '=', $id)->where('state', '=', 'accepted')->firstOrFail();
        }
        return response(json_encode($response));
    }
}
