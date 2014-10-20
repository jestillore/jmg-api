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

		$this->call('RPSeeder');
	}

}

class RPSeeder extends Seeder {

	public function run() {
		$superUser = new Role;
		$superUser->name = 'Super User';
		$superUser->save();

		$companyOwner = new Role;
		$companyOwner->name = 'Company Owner';
		$companyOwner->save();

		$manageCompanies = new Permission;
		$manageCompanies->name = 'manage_companies';
		$manageCompanies->display_name = 'Manage Companies';
		$manageCompanies->save();

		$manageJobs = new Permission;
		$manageJobs->name = 'manage_jobs';
		$manageJobs->display_name = 'Manage Jobs';
		$manageJobs->save();

		$superUser->perms()->sync([$manageCompanies->id, $manageJobs->id]);
		$companyOwner->perms()->sync([$manageJobs->id]);

	}

}
