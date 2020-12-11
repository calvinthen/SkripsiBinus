<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
class Team extends Model
{
    use HasFactory;
    protected $fillable = ['team_name','rank','photo_team','user_id','leader_id', 'first_member_id', 'second_member_id', 'third_member_id',
    'forth_member_id'];

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
