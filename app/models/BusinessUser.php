<?php

class BusinessUser extends Eloquent {
	 protected $table = 'business_users';
	 protected $fillable = array('business_name', 
	 							 'business_address', 
	 							 'business_email',
	 							 'business_description',
	 							 'business_address',
	 							 'username',
	 							 'password',
	 							 );
}