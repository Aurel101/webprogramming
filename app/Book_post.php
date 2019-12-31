<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_post extends Model
{
    protected $table = 'book_posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author', 'title', 'publisher', 'publishing_date','condition','description','price','image','user_id','state',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $casts = [
        'publishing_date'=>'date',
        'price' => 'double',
    ];
}
