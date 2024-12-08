<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The protected attributes
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $casts = [
        'id'        => 'integer',
        'user_id'   => 'integer',
        'title'     => 'string',
        'body'      => 'string',   
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function addComment($body)
    // {
    //     $this->comments()->create(compact('body'));
    // }
}
