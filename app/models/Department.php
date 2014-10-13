<?php

class Department extends BaseModel {

	protected $table = 'departments';
	public $timestamps = false;

	public static $relationsData = [
		'vessel' => [self::BELONGS_TO, 'Vessel', 'foreignKey' => 'vessel_id'],
		'ranks' => [self::HAS_MANY, 'Rank', 'foreignKey' => 'department_id']
	];

}
