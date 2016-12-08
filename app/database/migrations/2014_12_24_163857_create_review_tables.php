<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
        Schema::create('reviews', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('vendor_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->text('comments');
            $table->timestamps();
        });

        
        Schema::create('questions', function ($table) {
            $table->increments('id')->unsigned();
            $table->string('text');
        });

        
        Schema::create('ratings', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('review_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->foreign('review_id')->references('id')->on('reviews');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->integer('rating')->unsigned(); 
            
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

        Schema::drop('ratings');
        Schema::drop('questions');
		Schema::drop('reviews');
		
		
	}

}
