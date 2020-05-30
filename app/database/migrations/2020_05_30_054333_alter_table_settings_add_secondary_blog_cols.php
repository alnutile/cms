<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSettingsAddSecondaryBlogCols extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('settings', function(Blueprint $table)
		{
			if(!Schema::hasColumn('settings', 'secondary_blog_title'))
			{
				$table->string('secondary_blog_title')->default('Secondary Blog');
			}
			if(!Schema::hasColumn('settings', 'enable_secondary_blog'))
			{
				$table->boolean('enable_secondary_blog')->default(0);
			}
			if(!Schema::hasColumn('settings', 'enable_secondary_blog'))
			{
				$table->integer('secondary_blog_menu_position')->default(1);
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
