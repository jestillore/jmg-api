<?php

class JobsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!Auth::guest() && Auth::user()->hasRole('Company Owner')) {
			$category = Input::get('category');
			$job = Job::where('company_id', '=', Auth::user()->company->id);
			if($category) {
				$job->where('category', '=', $category)->get();
			}
			$filters = ['rank_id' => 'rankFilter', 'vessel_id' => 'vesselFilter', 'trade_route_id' => 'tradeRouteFilter', 'company_id' => 'companyFilter'];
			foreach($filters as $field => $filter) {
				$f = Input::get($filter);
				if($f) {
					$job->where($field, '=', $f);
				}
			}
			return $job->orderBy('created_at', 'DESC')->get();
		}
		else {
			$category = Input::get('category');
			if($category)
				$job = Job::where('category', '=', $category);
			else 
				$job = Job::where('category', 'like', '%');
			$filters = ['rank_id' => 'rankFilter', 'vessel_id' => 'vesselFilter', 'trade_route_id' => 'tradeRouteFilter', 'company_id' => 'companyFilter'];
			foreach($filters as $field => $filter) {
				$f = Input::get($filter);
				if($f) {
					$job->where($field, '=', $f);
				}
			}
			return $job->orderBy('created_at', 'DESC')->get();
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$job = new Job;
		$fields = ['company_id', 'category', 'rank_id', 'department_id', 'vessel_id', 'slots', 'vessel_flag', 'post_start', 'post_end', 'trade_route_id', 'description'];
		foreach($fields as $field) {
			$job->$field = array_get($input, $field);
		}
		$job->save();
		return $job;
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$job = Job::find($id);
		return $job;
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$job = Job::find($id);
		$job->delete();
		return [
			'success' => true
		];
	}

	public function today() {
		$date = date('Y-m-d');
		//$jobs = Job::where('post_start', $date)->whereIn('rank_id', Input::get('ranks'))->get();
		$jobs = Job::whereIn('rank_id', Input::get('ranks'))->get();
		return $jobs;
	}


}