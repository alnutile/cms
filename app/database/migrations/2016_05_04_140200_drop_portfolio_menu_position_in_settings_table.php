<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropPortfolioMenuPositionInSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('settings', function(Blueprint $table)
		{
			if(Schema::hasColumn('settings', 'portfolio_menu_postion'))
			{
			  $table->dropColumn('portfolio_menu_postion');
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
			if(!Schema::hasColumn('settings', 'portfolio_menu_postion'))
			{
				$table->integer('portfolio_menu_postion')->nullable();
			}
		});
	}

}
