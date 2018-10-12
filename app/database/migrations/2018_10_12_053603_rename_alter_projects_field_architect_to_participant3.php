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
		//
		Schema::table('projects', function(Blueprint $table)
		{
			$table->renameColumn('architect', 'participant3');
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
		Schema::table('projects', function(Blueprint $table)
		{
			$table->dropColumn(array('participant3'));
		});
	}

}
