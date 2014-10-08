<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('CategoriesSeeder');
	}

}

class CategoriesSeeder extends Seeder {

	public function run() {
		$urgent = new Category;
		$urgent->name = 'Urgent';
		$urgent->save();

		$deployment = new Category;
		$deployment->name = 'Deployment';
		$deployment->save();

		$pooling = new Category;
		$pooling->name = 'Pooling';
		$pooling->save();
	}

}
