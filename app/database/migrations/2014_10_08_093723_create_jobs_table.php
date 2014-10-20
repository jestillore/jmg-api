<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobs', function ($table) {
			$table->increments('id');
			$table->integer('company_id');
			$table->integer('category_id');
			$table->string('rank');
			$table->string('department');
			$table->string('vessel');
			$table->integer('slots');
			$table->string('vessel_flag');
			$table->date('post_start');
			$table->date('post_end');
			$table->string('trade_route');
			$table->text('description')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jobs');
	}

}
