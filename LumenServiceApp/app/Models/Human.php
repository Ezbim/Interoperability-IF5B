<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Human extends Model
{
    protected $fillable = array('name','age','hobby','address','phone','email');
}