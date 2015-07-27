<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddThumbsFieldsToProjectsTable extends Migration {

	/**
	 * Make changes to the table.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::table('projects', function(Blueprint $table) {		
			
			$table->string('thumbs_file_name')->nullable();
			$table->integer('thumbs_file_size')->nullable();
			$table->string('thumbs_content_type')->nullable();
			$table->timestamp('thumbs_updated_at')->nullable();

		});

	}

	/**
	 * Revert the changes to the table.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('projects', function(Blueprint $table) {

			$table->dropColumn('thumbs_file_name');
			$table->dropColumn('thumbs_file_size');
			$table->dropColumn('thumbs_content_type');
			$table->dropColumn('thumbs_updated_at');

		});
	}

}
