<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIntroColToSecondaryBlog extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('secondary_posts', function(Blueprint $table)
		{
			if(!Schema::hasColumn('secondary_posts', 'intro'))
			{
				$table->text('intro')->nullable();
			}
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
