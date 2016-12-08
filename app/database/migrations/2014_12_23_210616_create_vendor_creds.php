<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorCreds extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('certifications', function ($table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned();
            $table->string('name');
            $table->string('state');
            $table->string('value');
            $table->date('date');
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
		Schema::drop('certifications');
	}

}
