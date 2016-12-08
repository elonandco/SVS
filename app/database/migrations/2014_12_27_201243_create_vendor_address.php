<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorAddress extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('vendors', function($table)
		{
		    $table->string('zip')->after('owner');
		    $table->string('state')->after('owner');
		    $table->string('city')->after('owner');
		    $table->string('address')->after('owner');
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
			  $table->dropColumn('zip');
			  $table->dropColumn('state');
			  $table->dropColumn('city');
			  $table->dropColumn('address');
		});
	}

}
