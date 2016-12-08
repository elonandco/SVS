<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bids', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id');
            $table->string('name');
            $table->boolean('active');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('bid_vendor', function ($table) {
        	$table->increments('id')->unsigned();
        	$table->integer('bid_id');
        	$table->integer('vendor_id');
        	$table->unique(array('bid_id', 'vendor_id'));
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bids');
		Schema::drop('bid_vendor');
	}

}
