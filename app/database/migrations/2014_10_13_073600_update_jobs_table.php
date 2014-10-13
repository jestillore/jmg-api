<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('jobs', function ($table) {
			$table->dropColumn('category_id');
			$table->dropColumn('rank');
			$table->dropColumn('department');
			$table->dropColumn('vessel');
			$table->dropColumn('vessel_flag');
			$table->string('category');
			$table->integer('rank_id');
			$table->integer('department_id');
			$table->integer('vessel_id');
			$table->integer('vessel_flag_id');
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
	}

}
