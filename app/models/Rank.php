<?php

class Rank extends BaseModel {

	protected $table = 'ranks';
	public $timetamps = false;

	public static $relationsData = [
		'vessel' => [self::BELONGS_TO, 'Vessel', 'foreignKey' => 'vessel_id'],
		'department' => [self::BELONGS_TO, 'Department', 'foreignKey' => 'department_id']
	];

}
