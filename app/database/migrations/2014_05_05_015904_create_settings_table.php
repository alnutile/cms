<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('logo')->nullable();
			$table->string('color')->default('blue');
			$table->string('facebook')->nullable();
			$table->string('linkedin')->nullable();
			$table->string('twitter')->nullable();
			$table->string('pinterest')->nullable();
			$table->text('footer')->nullable();
			$table->boolean('maintenance_mode')->default(0);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('settings');
	}

}
