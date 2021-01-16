<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review_vote extends Model
{
    use HasFactory;

    protected $fillable = ['review_id','user_id','upvote','downvote'];
}
