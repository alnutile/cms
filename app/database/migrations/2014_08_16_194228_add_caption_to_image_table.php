<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCaptionToImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::table('images', function(Blueprint $table)
    {
      $table->string('image_caption', 120)->nullable();
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
    Schema::table('images', function(Blueprint $table)
    {
      $table->dropColumn('image_caption');
    });
	}

}
