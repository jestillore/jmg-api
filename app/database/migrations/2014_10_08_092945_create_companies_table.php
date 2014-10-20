<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function ($table) {
			$table->increments('id');
			$table->string('name');
			$table->string('poea');
			$table->date('validity');
			$table->string('address');
			$table->string('telephone');
			$table->string('fax');
			$table->string('website');
			$table->integer('contact_person_id');
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
		Schema::drop('companies');
	}

}
