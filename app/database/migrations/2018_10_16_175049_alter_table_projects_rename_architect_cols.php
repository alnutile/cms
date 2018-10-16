<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableProjectsRenameArchitectCols extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects', function (Blueprint $table) {
			$table->renameColumn('architect', 'participant3');
		});
		//
		//DB::statement("ALTER TABLE `projects` CHANGE `architect` `participant3` VARCHAR(255) DEFAULT NULL");
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
