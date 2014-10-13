<?php

class CompanyController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Company::all();
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$company = new Company;
		$companyFields = ['name', 'poea', 'validity', 'address', 'telephone', 'fax', 'website'];
		$personFields = ['firstname', 'lastname', 'designation', 'email', 'telephone', 'fax'];
		foreach($companyFields as $field) {
			$company->$field = array_get($input, $field);
		}
		$contactPerson = new ContactPerson;
		foreach($personFields as $field) {
			$contactPerson->$field = array_get($input, 'cp_' . $field);
		}
		$contactPerson->save();
		$company->contact_person_id = $contactPerson->id;
		$company->save();
		return $company;

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$company = Company::find($id);
		return $company;
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
		$input = Input::all();
		$company = Company::find($id);
		$companyFields = ['name', 'poea', 'validity', 'address', 'telephone', 'fax', 'website'];
		$personFields = ['firstname', 'lastname', 'designation', 'email', 'telephone', 'fax'];
		foreach($companyFields as $field) {
			$company->$field = array_get($input, $field);
		}
		foreach($personFields as $field) {
			$company->contact_person->$field = array_get($input, 'cp_' . $field);
		}
		$company->contact_person->save();
		$company->save();
		return $company;
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$company = Company::find($id);
		$company->contact_person->delete();
		$company->delete();
		return [
			'success' => true
		];
	}


}
