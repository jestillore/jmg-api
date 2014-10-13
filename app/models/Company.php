<?php

class Company extends BaseModel {

	protected $table = 'companies';

	public static $relationsData = [
		'contact_person' => [self::BELONGS_TO, 'User', 'foreignKey' => 'contact_person_id'],
		'jobs' => [self::HAS_MANY, 'Job', 'foreignKey' => 'company_id']
	];

	public function toArray() {
		$this->load('contact_person');
		return parent::toArray();
	}

}
