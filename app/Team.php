<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
class Team extends Model
{
    use HasFactory;
    protected $table = "teams";
    protected $fillable = ['team_name','rank','photo_team','user_id','leader_id', 'first_member_id', 'second_member_id', 'third_member_id',
    'forth_member_id','game_prefer'];

    public function User()
    {

        return $this->hasMany(User::class);
    }
}
