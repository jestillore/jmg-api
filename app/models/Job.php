<?php

class Job extends BaseModel {

	protected $table = 'jobs';

	public static $relationsData = [
		'company' => [self::BELONGS_TO, 'Company', 'foreignKey' => 'company_id'],
		'department' => [self::BELONGS_TO, 'Department', 'foreignKey' => 'department_id'],
		'rank' => [self::BELONGS_TO, 'Rank', 'foreignKey' => 'rank_id'],
		'vessel' => [self::BELONGS_TO, 'Vessel', 'foreignKey' => 'vessel_id'],
		'vessel_flag' => [self::BELONGS_TO, 'VesselFlag', 'foreignKey' => 'vessel_flag_id'],
		'trade_route' => [self::BELONGS_TO, 'TradeRoute', 'foreignKey' => 'trade_route_id']
	];

	public function toArray() {
		$this->load('company', 'department', 'vessel', 'vessel_flag', 'trade_route', 'rank');
		return parent::toArray();
	}

}
