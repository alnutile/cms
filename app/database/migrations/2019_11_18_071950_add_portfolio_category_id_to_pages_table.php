<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPortfolioCategoryIdToPagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (Schema::hasColumn('pages', 'portfolio_category_id'))
		{
			Schema::table('pages', function(Blueprint $table)
			{
				$table->dropColumn('portfolio_category_id');
			});
		}
		if (!Schema::hasColumn('pages', 'portfolio_category_id'))
		{
			Schema::table('pages', function(Blueprint $table)
			{
				$table->text('portfolio_category_id')->nullable();
			});
		}
		
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pages', function(Blueprint $table)
		{
			//
		});
	}

}
