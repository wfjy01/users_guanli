<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;


class Admin extends User
{
    //允许更改的字段
    protected $fillable=[
      'name','password','photo'
    ];
}
