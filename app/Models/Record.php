<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //允许更改的字段
    protected $fillable=[
      'user_id','status','money'
    ];

    //一多多连接
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
