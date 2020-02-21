<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping_address extends Model
{
    protected $table = 'shipping_address';

    protected $fillable = [
        'user_id','country','postnumber','city','address'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
