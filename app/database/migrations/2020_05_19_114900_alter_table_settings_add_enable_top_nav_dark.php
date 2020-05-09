<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSettingsAddEnableTopNavDark extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('settings', function(Blueprint $table)
		{
			if(!Schema::hasColumn('settings', 'enable_top_nav_dark'))
			{
				$table->text('enable_top_nav_dark')->tinyint(1)->default(0);
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
		Schema::table('settings', function(Blueprint $table)
		{
			//
		});
	}

}
