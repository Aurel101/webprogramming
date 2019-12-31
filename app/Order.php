<?php

namespace App;
use App\OrderPost;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

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
}
