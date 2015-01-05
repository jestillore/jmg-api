<?php

class Company extends BaseModel {

	protected $table = 'companies';

	protected $hidden = ['created_at', 'updated_at'];

	public static $relationsData = [
		'contact_person' => [self::BELONGS_TO, 'User', 'foreignKey' => 'contact_person_id'],
		'jobs' => [self::HAS_MANY, 'Job', 'foreignKey' => 'company_id']
	];

	public function toArray() {
		$this->load('contact_person');
		$this->logo = URL::to('logos/company-') . $this->id . '.jpg';
		return parent::toArray();
	}
	
	public static $rules = [
		'name' => 'required|unique:companies',
		'poea' => 'required|unique:companies'
	];

}
