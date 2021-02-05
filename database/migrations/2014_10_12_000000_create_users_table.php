<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role');

            $table->bigInteger('team_id')->nullable()->unsigned();

            $table->string('team')->nullable();

            $table->string('game_prefer');
            $table->string('role_game');
            $table->string('ingame_id')->unique();

            $table->float('point')->default(0);

            $table->string('photo_profile')->default('user.jpg');

            $table->timestamp('email_verified_at')->nullable();

            $table->timestamp('banned_started')->nullable();
            $table->timestamp('banned_until')->nullable();
            $table->string('password');

            $table->rememberToken();
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
