<?php

class Job extends BaseModel {

	protected $table = 'jobs';

	protected $hidden = ['created_at', 'updated_at', 'rank', 'vessel', 'vessel_flag', 'department', 'trade_route'];

	public static $relationsData = [
		'company' => [self::BELONGS_TO, 'Company', 'foreignKey' => 'company_id'],
		'department' => [self::BELONGS_TO, 'Department', 'foreignKey' => 'department_id'],
		'rank' => [self::BELONGS_TO, 'Rank', 'foreignKey' => 'rank_id'],
		'vessel' => [self::BELONGS_TO, 'Vessel', 'foreignKey' => 'vessel_id'],
		'trade_route' => [self::BELONGS_TO, 'TradeRoute', 'foreignKey' => 'trade_route_id']
	];

	public function toArray() {
		$this->load('company', 'department', 'vessel', 'trade_route', 'rank');
		$this->rankName = $this->rank->name;
		$this->vesselName = $this->vessel->name;
		$this->vesselFlagName = $this->vessel_flag;
		$this->departmentName = $this->department->name;
		$this->tradeRouteName = $this->trade_route->name;
		return parent::toArray();
	}

}
