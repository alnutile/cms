<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMenuToPages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pages', function(Blueprint $table)
		{
			$table->integer('menu_sort_order')->default(1);
			$table->integer('menu_parent')->default(0);
			$table->string('menu_name')->default('top');
			$table->string('redirect_url')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('pages');
	}

}
