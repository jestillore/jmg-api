<?php

class Job extends BaseModel {

	protected $table = 'jobs';

	public static $relationsData = [
		'company' => [self::BELONGS_TO, 'Company', 'foreignKey' => 'company_id'],
		'category' => [self::BELONGS_TO, 'Category', 'foreignKey' => 'category_id']
	];

	public function toArray() {
		$this->load('company', 'category');
		return parent::toArray();
	}

}
