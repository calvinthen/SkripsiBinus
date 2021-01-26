<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_chats', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('team_id')->nullable()->unsigned();
            $table->bigInteger('sender_id')->nullable()->unsigned();
            $table->string('chat');
            $table->timestamps();


            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('sender_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_chats');
    }
}
