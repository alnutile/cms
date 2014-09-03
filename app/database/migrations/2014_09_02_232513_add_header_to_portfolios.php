<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHeaderToPortfolios extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('portfolios', function(Blueprint $table)
    {
      $table->string('header', 120)->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('portfolios', function(Blueprint $table)
    {
      $table->dropColumn('header');
    });
  }

}
