<?php

class Vessel extends BaseModel {

	protected $table = 'vessels';
	public $timestamps = false;

	public static $relationsData = [
		'departments' => [self::HAS_MANY, 'Department', 'foreignKey' => 'vessel_id'],
		'ranks' => [self::HAS_MANY, 'Rank', 'foreignKey' => 'vessel_id']
	];

}
