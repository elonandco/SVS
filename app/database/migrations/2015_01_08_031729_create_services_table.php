<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Creates the roles table
        Schema::create('services', function ($table) {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('service_vendor', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->integer('vendor_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('vendor_id')->references('id')->on('vendors');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('service_vendor');
		Schema::drop('services');
        
	}

}
