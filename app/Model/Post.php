<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use DB;

class Post extends Model
{
    protected $table = 'posts';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function Comments()
    {
        return $this->hasMany('App\Model\Comment');
    }
}
