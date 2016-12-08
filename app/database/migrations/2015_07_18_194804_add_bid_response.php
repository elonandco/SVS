<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBidResponse extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bid_vendor', function($table)
		{
		    $table->string('response')->nullable();		    
		    $table->timestamp('response_timestamp')->nullable();		    
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bid_vendor', function($table)
		{
		    $table->dropColumn('response');
		    $table->dropColumn('response_timestamp');
		});
	}

}
