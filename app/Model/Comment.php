<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use DB;

class Comment extends Model
{
    protected $table = 'comments';
    protected $guarded = [];

    public function Post()
    {
        return $this->belongsTo('App\Model\Post');
    }
}
