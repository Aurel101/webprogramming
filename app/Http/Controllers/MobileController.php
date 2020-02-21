<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Book_post;

class MobileController extends Controller
{
    public function process(Request $request){

        $email=null;
        $password=null;
        if(empty($request->email) || empty($request->password)){
            return response(json_encode([['error'=>'Please fill all spaces']]));
        }
        else{
            $email=$request->email;//json_decode($request->email);
            $password = $request->password;//json_decode($request->password);
        }

        $user = User::where('email',$email)->first();

        if($user!==null){
            if(Hash::check($password, $user->password)){
                $posts = Book_post::where('user_id',$user->id)->get();
                return response(json_encode($posts));
            }
            else{
                return response(json_encode([['error' => 'Email or password is incorrect']]));
            }
        }
        else{
            return response(json_encode([['error' => 'Email or password is incorrect']]));
        }

    }
}
