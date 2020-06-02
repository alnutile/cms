<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePortfolioCategoryAddSortOrderCol extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('portfolio_category', function(Blueprint $table)
		{
			if(!Schema::hasColumn('portfolio_category', 'sort_order'))
			{
				$table->integer('sort_order')->default(1);
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
		Schema::table('portfolio_category', function(Blueprint $table)
		{
			$table->dropColumn('sort_order');
		});
	}

}
