<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactPersonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contact_persons', function ($table) {
			$table->increments('id');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('designation');
			$table->string('email');
			$table->string('telephone');
			$table->string('fax');
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
		Schema::drop('contact_persons');
	}

}
