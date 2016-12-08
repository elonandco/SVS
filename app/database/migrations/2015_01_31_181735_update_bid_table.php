<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBidTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bids', function($table)
		{
		    $table->date('start_date')->after('user_id');
		    $table->date('end_date')->after('user_id');
		    $table->string('type')->after('user_id');
		    $table->text('description')->after('user_id');
		    $table->integer('category_id')->after('user_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bids', function($table)
		{
		    $table->dropColumn('start_date');
		    $table->dropColumn('end_date');
		    $table->dropColumn('type');
		    $table->dropColumn('description');
		    $table->dropColumn('category_id');
		});
	}

}
