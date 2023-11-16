<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productcategory extends Model
{
    protected $fillable = array('name','description','slug','parent_id','image_path','active');
}