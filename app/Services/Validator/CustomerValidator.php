<?php

namespace App\Services\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Customer;

class CustomerValidator
{

	public $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function checkValidation($form_name, $id = false)
	{
		//return $id
		switch ($form_name) {
			case 'customer':
				$rules = [
					'first_name' => 'required',
					'last_name' => 'required',
					'email' => 'required'
				];
				if ($id) {

					$rules['phone'] = ['required', 'unique' => function ($attributes, $value, $fail) use ($id) {
						$phone_exits = Customer::where('id', '!=', $id)->where('phone', $this->request->phone)->where('country_code', $this->request->country_code)->first();
						if ($phone_exits) {
							$fail('Phone already exits');
						}
					}];
				} else {
					$rules['phone'] = ['required', 'unique' => function ($attributes, $value, $fail) {
						$phone_exits = Customer::where('phone', $this->request->phone)->where('country_code', $this->request->country_code)->first();
						if ($phone_exits) {
							$fail('Phone already exits');
						}
					}];
				}

				$validator = Validator::make($this->request->all(), $rules);
				if ($validator->fails()) {
					return ['fail' => $validator];
				}
				break;

			case 'user':
				$rules = [
					'name' => ['required', 'string', 'max:255'],
					'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
					'password' => ['required', 'string', 'min:8', 'confirmed'],
				];
				if ($id) {
					if (!$this->request->password) {
						$rules['password'] = ['nullable']; // code...
					}

					$rules['email'] = ['required', 'unique' => function ($attributes, $value, $fail) use ($id) {
						$phone_exits = \App\User::where('id', '!=', $id)->where('email', $this->request->email)->first();
						if ($phone_exits) {
							$fail('Email already exits');
						}
					}];
				}


				$validator = Validator::make($this->request->all(), $rules);
				if ($validator->fails()) {
					return ['fail' => $validator];
				}
				break;
			case 'user_profile':
				$rules = ['name' => ['required', 'string', 'max:255']];
				$rules['email'] = ['required', 'unique' => function ($attributes, $value, $fail) use ($id) {
					$phone_exits = \App\User::where('id', '!=', $id)->where('email', $this->request->email)->first();
					if ($phone_exits) {
						$fail('Email already exits');
					}
				}];
				$validator = Validator::make($this->request->all(), $rules);
				if ($validator->fails()) {
					return ['fail' => $validator];
				}
				break;

			case 'change_password':
				$rules = ['password' => ['required', 'string', 'min:8', 'confirmed']];
				$validator = Validator::make($this->request->all(), $rules);
				if ($validator->fails()) {
					return ['fail' => $validator];
				}
				break;



			default:
				# code...
				break;
		}

		return $this->request;
	}
}
