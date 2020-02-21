<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPost extends Model
{
    //
    protected $table = 'order_post';

    protected $fillable = ['order_id','post_id','price'];

    public function order(){
        return $this->belongsTo('App\Order');
    }
    public function book_post(){
        return $this->hasOne('App\Book_post','id','post_id');
    }
}
