<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/login', 'BusinessAuthController@index');
Route::post('/login', 'BusinessAuthController@login');
Route::get('/register', 'BusinessAuthController@register');
Route::post('/register', 'BusinessAuthController@save');
Route::get('/logout', 'BusinessAuthController@logout');


Route::get('/dashboard', 'BusinessMainController@dashboard');

Route::get('/', function()
{
	return '';
});

Route::group(['prefix' => '/api/v1'], function ()
{
    # Set Namespace
    $namespace = 'SourceScript\V1\\';

    ###############################################################
    # API
    ###############################################################
    Route::group(['before' => 'oauth:user'], function() use ($namespace)
    {
        Route::get('/users/profile', $namespace.'User\UserController@userProfile');
        Route::resource('/users',$namespace.'User\UserController', ['only' => ['update', 'show']]);

        Route::resource('/badges', $namespace.'Badges\BadgesController', ['only' => 'index', 'show']);

        Route::resource('/challenges', $namespace.'Challenges\ChallengesController', ['only' => ['index', 'show']]);
        Route::post('/challenges/{id}/accept', $namespace.'User\UserController@acceptChallenge');

        Route::resource('/business', $namespace.'Business\BusinessController', ['only' => ['index', 'show']]);

        Route::resource('/rewards', $namespace.'Rewards\RewardsController', ['only' => ['index', 'show']]);
        Route::post('/rewards/{id}/claim', $namespace.'User\UserController@claimReward');
    });



    ################################################################
    # OAUTH
    ################################################################

    Route::post('/oauth/access_token', function()
    {
        return AuthorizationServer::performAccessTokenFlow();
    });


    Route::get('/oauth/authorize', array('before' => 'check-authorization-params|auth', function()
    {
        // get the data from the check-authorization-params filter
        $params = Session::get('authorize-params');

        // get the user id
        $params['user_id'] = Auth::user()->id;

        // display the authorization form
        return View::make('authorization-form', array('params' => $params));
    }));


    Route::post('/oauth/authorize', array('before' => 'check-authorization-params|auth|csrf', function()
    {
        // get the data from the check-authorization-params filter
        $params = Session::get('authorize-params');

        // get the user id
        $params['user_id'] = Auth::user()->id;

        // check if the user approved or denied the authorization request
        if (Input::get('approve') !== null) {

            $code = AuthorizationServer::newAuthorizeRequest('user', $params['user_id'], $params);

            Session::forget('authorize-params');

            return Redirect::to(AuthorizationServer::makeRedirectWithCode($code, $params));
        }

        if (Input::get('deny') !== null) {

            Session::forget('authorize-params');

            return Redirect::to(AuthorizationServer::makeRedirectWithError($params));
        }
    }));

});

