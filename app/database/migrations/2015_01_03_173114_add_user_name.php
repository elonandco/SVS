<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserName extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
		    $table->string('last_name')->after('name');
		    $table->renameColumn('name', 'first_name');
		    
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table)
		{
		    $table->renameColumn('first_name', 'name');
		    $table->dropColumn('last_name');
		});
	}

}
