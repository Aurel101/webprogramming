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

     'user_id', 'condition', 'description', 'image', 'author',
        'title', 'publisher', 'publishing_date', 'price', 'state',
    ];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id','created_at', 'updated_at',
    ];
    /**
     * @var array
     */
    protected $casts = [
        'publishing_date'=>'date',
        'price' => 'double',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
