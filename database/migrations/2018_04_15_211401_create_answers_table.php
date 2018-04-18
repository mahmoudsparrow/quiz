<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
//            $table->integer('userID')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->text('answer');
            $table->boolean('isRight')->default(0);
            $table->timestamps();

//            $table->foreign('userID')->references('id')->on('users');
//            $table->foreign('questionID')->references('id')->on('questions');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
