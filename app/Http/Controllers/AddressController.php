<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shipping_address;

class AddressController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','verified']);
    }

    public function shownew(){
        return view('newaddress');
    }

    public function make(Request $request){
        $id = Auth::id();
        $request->validate([
            'country' => 'required|string|max:100',
            'postnumber' => 'required|string|max:10',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'captcha' => 'required|captcha'
        ]);

        $address = new Shipping_address;
        $address->user_id = $id;
        $address->country = $request->country;
        $address->postnumber = $request->postnumber;
        $address->city = $request->city;
        $address->address = $request->address;
        $address->save();

        return redirect('profile');
    }

    public function showmodify(string $id){
        $user_id = Auth::id();
        if (!ctype_digit($id)) {
            return redirect($to = '/' . $id);
        }
        $address = Shipping_address::whereRaw('user_id = ? AND id = ? ', [$user_id, $id])->firstOrFail();
        if (isset($address)) {
            return view('modifyaddress', ['address' => $address]);
        }
    }

    public function modify(string $id,Request $request){
        $user_id = Auth::id();
        $request->validate([
            'country' => 'required|string|max:100',
            'postnumber' => 'required|string|max:10',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'captcha' => 'required|captcha'
        ]);
        $address = Shipping_address::whereRaw('user_id = ? AND id = ? ', [$user_id, $id])->firstOrFail();
        $address->country = $request->country;
        $address->postnumber = $request->postnumber;
        $address->city = $request->city;
        $address->address = $request->address;
        $address->save();
        return redirect('profile');
    }
    public function delete(string $id){
        $user_id = Auth::id();
        if (!ctype_digit($id)) {
            return redirect($to = '/' . $id);
        }
        $address = Shipping_address::whereRaw('user_id = ? AND id = ? ', [$user_id, $id])->firstOrFail();
        if(isset($address)){
            $address->delete();
            return redirect('profile');
        }
    }

}
