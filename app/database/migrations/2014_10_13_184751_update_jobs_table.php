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
			$table->dropColumn('rank_id');
			$table->dropColumn('department_id');
			$table->dropColumn('vessel_id');
			$table->dropColumn('vessel_flag_id');
			$table->dropColumn('trade_route_id');

			$table->integer('rank_id')->nullable();
			$table->integer('department_id')->nullable();
			$table->integer('vessel_id')->nullable();
			$table->integer('vessel_flag_id')->nullable();
			$table->integer('trade_route_id')->nullable();
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
