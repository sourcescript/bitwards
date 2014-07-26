<?php

class BusinessAuthController extends BaseController {

	public function index()
	{
		return View::make('/business/login');
	}

	public function register()
	{
		return View::make('/business/register');
	}

	public function save()
	{
		$business_name = Input::get('business_name');
		$business_address = Input::get('business_address');
		$business_description = Input::get('business_description');
		$business_email= Input::get('business_email');
		$username= Input::get('username');
		$password= Input::get('password');


		BusinessUser::create([
					'business_name' => $business_name,
					'business_address' => $business_address,
					'business_description' => $business_description,
					'business_email' => $business_email,
					'username' => $username,
					'password' => $password,

				]);

		return View::make('/business/congrats_register');
	}

	public function login()
	{
		$username = Input::get('username');
		$password = Input::get('password');
		$user = BusinessUser::where('username', $username)
						->where('password', $password)
						->first();

			Session::put('business_user', $user->id);
			return Redirect::to('/dashboard');
		
	}

	public function logout()
	{

	}



}