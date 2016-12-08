<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeVendorAttrsNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement("ALTER TABLE `vendors` CHANGE `phone` `phone` VARCHAR(255)  CHARACTER SET utf8  COLLATE utf8_unicode_ci  NULL  DEFAULT ''");
		DB::statement("ALTER TABLE `vendors` CHANGE `address` `address` VARCHAR(255)  CHARACTER SET utf8  COLLATE utf8_unicode_ci  NULL  DEFAULT ''");
		DB::statement("ALTER TABLE `vendors` CHANGE `zip` `zip` VARCHAR(255)  CHARACTER SET utf8  COLLATE utf8_unicode_ci  NULL  DEFAULT ''");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement("ALTER TABLE `vendors` CHANGE `phone` `phone` VARCHAR(255)  CHARACTER SET utf8  COLLATE utf8_unicode_ci  NOT NULL  DEFAULT ''");
		DB::statement("ALTER TABLE `vendors` CHANGE `address` `address` VARCHAR(255)  CHARACTER SET utf8  COLLATE utf8_unicode_ci  NOT NULL  DEFAULT ''");
		DB::statement("ALTER TABLE `vendors` CHANGE `zip` `zip` VARCHAR(255)  CHARACTER SET utf8  COLLATE utf8_unicode_ci  NOT NULL  DEFAULT ''");
	}

}
