<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Friend extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','user_id2'];

    public function Friend()
    {
        return $this->belongsToMany(User::class,'user_id','id');
    }
}
