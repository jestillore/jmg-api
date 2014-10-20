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
			if($category) {
				return Job::where('category', $category)->where('company_id', Auth::user()->company->id)->get();
			}
			return Job::where('company_id', Auth::user()->company->id)->get();
		}
		else {
			$category = Input::get('category');
			if($category) {
				return Job::where('category', $category)->get();
			}
			return Job::all();
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
		$fields = ['company_id', 'category', 'rank_id', 'department_id', 'vessel_id', 'slots', 'vessel_flag_id', 'post_start', 'post_end', 'trade_route_id', 'description'];
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


}
