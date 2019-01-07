<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    protected $fillable = ['title','user_id','content'];
    use SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
