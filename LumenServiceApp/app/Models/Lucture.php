<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lucture extends Model
{
    protected $fillable = array('name','email','department','telephone','address','numberOfStudent');
}