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
		$contactPerson = new User;
		foreach($personFields as $field) {
			$contactPerson->$field = array_get($input, 'cp_' . $field);
		}
		$contactPerson->username = $contactPerson->email;
		$password = str_random(10);
		$contactPerson->password = $password;
		$companyOwner = Role::where('name', 'Company Owner')->firstOrFail();
		$contactPerson->role = $companyOwner->id;
		$contactPerson->confirmation_code = str_random(30);
		$contactPerson->confirmed = true;
		if($contactPerson->save()) {
			$contactPerson->attachRole($companyOwner);
			$company->contact_person_id = $contactPerson->id;
			if($company->save()) {
				$fileName = 'company-' . $company->id;
				$file = Input::file('file');
				$file->move(public_path() . '/logos/', $fileName . '.jpg');
				return $company;
			}
			$contactPerson->delete();
			return Response::make($company->errors(), 500);
		}
		return Response::make($contactPerson->errors(), 500);

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

	public function sendMail($id) {
		$company = Company::find($id);
		$contactPerson = User::find($company->contact_person_id); // it must be $company->contact_person but dunno why the hell it won't work
		$password = $contactPerson->password;
		$data = [
			'company' => $company->name,
			'email' => $contactPerson->email,
			'password' => $password,
			'confirmationCode' => $contactPerson->confirmation_code
		];
		Mail::send('emails.email', $data, function ($message) use($contactPerson) {
			$message->to($contactPerson->email, $contactPerson->firstname . ' ' . $contactPerson->lastname)->subject('JMG Account');
		});
		$contactPerson->password = Hash::make($contactPerson->password);
		$contactPerson->updateUniques();
	}


}