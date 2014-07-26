<?php

class BusinessMainController extends BaseController {

	public function dashboard()
	{
		$data['user'] = BusinessUser::where('id',Session::get('business_user'))
									 ->first();

		return View::make('/business/dashboard')->with($data);
	}
}