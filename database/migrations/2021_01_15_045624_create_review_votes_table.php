<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_votes', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('review_id')->nullable()->unsigned();
            $table->bigInteger('user_id')->nullable()->unsigned();

            $table->integer('upvote')->default(0);
            $table->integer('downvote')->default(0);
            $table->timestamps();

            $table->foreign('review_id')->references('id')->on('reviews');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_votes');
    }
}
