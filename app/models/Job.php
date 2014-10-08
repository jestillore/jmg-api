<?php

class Job extends BaseModel {

	protected $table = 'jobs';

	public static $relationsData = [
		'company' => [self::BELONGS_TO, 'Company', 'foreignKey' => 'company_id']
	];

	public function toArray() {
		$this->load('company');
		return parent::toArray();
	}

}
