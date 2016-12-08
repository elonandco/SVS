<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::create('vendors', function ($table) {
           
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('name');
            $table->string('slug', 128)->unique();
            $table->string('owner');
            $table->string('phone');
            $table->string('email');
            $table->string('url');
            $table->text('description');
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vendors');
	}

}
