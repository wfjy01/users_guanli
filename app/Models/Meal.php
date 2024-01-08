<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    //允许更改的字段
    protected $fillable=[
        'name','money','content'
    ];
}
