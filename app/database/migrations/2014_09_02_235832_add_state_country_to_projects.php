<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStateCountryToProjects extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('projects', function(Blueprint $table)
    {
      $table->string('state_country', 70)->nullable();
    });
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
      $table->dropColumn('state_country');
    });
  }

}
