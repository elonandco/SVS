<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArdynZipCodesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {

    Schema::create('zip_codes', function(Blueprint $table) {

      // Create the zip_codes table
      $table->char('ZIPCode', 5);
      $table->decimal('Latitude', 9, 6);
      $table->decimal('Longitude', 9, 6);
      $table->string('State');
      $table->string('City');
      $table->string('County');

      $table->primary('ZIPCode');
      $table->index('Latitude');
      $table->index('Longitude');

    });

  } /* function up */



  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {

    // Drop the table
    Schema::drop('zip_codes');

  } /* function down */

} /* class CreateArdynZipCodesTable */

/* EOF */
