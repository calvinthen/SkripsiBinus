<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teamChat extends Model
{
    use HasFactory;
    protected $fillable = ['chat','team_id','sender_id'];
}
