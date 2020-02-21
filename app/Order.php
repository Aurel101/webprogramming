<?php

namespace App;
use App\OrderPost;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable=[
        'user_id','time','price','address_id'
    ];

    public function add_to_order(int $post_id,float $price){
        if(isset($this->attributes['id'])){
            $order = new OrderPost();
            $order->order_id=$this->attributes['id'];
            $order->post_id=$post_id;
            $order->price = $price;
            $order->save();
            return true;
        }
        else{
            return false;
        }
    }
    public function order_post(){
        return $this->hasMany('App\OrderPost','order_id','id');
    }
    public function shipping_address(){
        return $this->belongsTo('App\Shipping_address',$ownerKey='address_id');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
