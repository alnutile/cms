<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('pages', function(Blueprint $table) {
            $table->increments('id');
			$table->string('title');
			$table->text('body');
			$table->string('slug')->nullable();
			$table->boolean('published')->default(0);
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
	    Schema::dropIfExists('pages');
	}

}
