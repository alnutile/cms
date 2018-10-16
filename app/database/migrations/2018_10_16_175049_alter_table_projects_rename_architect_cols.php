<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameAlterProjectsFieldArchitectToParticipant3 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects', function (Blueprint $table) {
			$table->renameColumn('architect', 'participant3');
			$table->string('participant3',255)->nullable()->change();
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
		Schema::table('projects', function(Blueprint $table)
		{
			$table->renameColumn('participant3', 'architect');
		});

	}

}
