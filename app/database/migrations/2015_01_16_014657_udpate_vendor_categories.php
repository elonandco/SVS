<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UdpateVendorCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('vendors', function($table)
		{
		    $table->dropColumn('category_id');
		});

		 Schema::create('category_vendor', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('vendor_id')->unsigned();
            $table->boolean('primary')->default(false);

            $table->foreign('category_id')->references('id')->on('categories');
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
		Schema::table('vendors', function($table)
		{
		    $table->integer('category_id')->after('user_id');
		});

		Schema::drop('category_vendor');
	}

}
