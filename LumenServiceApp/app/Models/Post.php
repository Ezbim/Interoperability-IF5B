<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = array('title','content','status','user_id','categories_id','students_id');

    public $timestamps = true;
}