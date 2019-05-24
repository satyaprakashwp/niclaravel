<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

/*  -------------   Check Instagram Details  --------------*/ 

define('base_url',                  'http://localhost/laravel');

define('_INSTAGRAM_CLIENT_ID',      '087d5afe7e81488883e6d1edeeae7daa');
define('_INSTAGRAM_CLIENT_SECRET',  '32806813cff4408e9706817041da2974');
define('_INSTAGRAM_REDIRECT_URL',   'http://localhost/laravel/callback');

/*  -------------   Check twitter  --------------*/ 

define('CONSUMER_KEY', '23zmrDwYgUETfQz1N77tQ9NTQ'); 	// add your app consumer key between single quotes
define('CONSUMER_SECRET', 'N17Z5eGNHj3Nkun1INLkSqbWgkDn0PKLbm1KEpQzyUaUwj5Chi'); // add your app consumer 																			secret key between single quotes
define('OAUTH_CALLBACK', 'http://localhost/laravel/twitter-callback');

//Route::get('/text',       'Collaborators@index');


/*Route::get('/Parent',          'ScrapingController@index');
Route::get('/citations',       'ScholarRecourd@citations');
Route::get('/Co-authors',      'ScholarRecourd@coauthors');
Route::get('/profile-address', 'ProfileAddress@getAddress');*/


Route::get('/signup',                   'ProfileController@index');
Route::post('/create-account-submit',   'ProfileController@register_submit');

Route::get('/signin',                   'ProfileController@signin');
Route::post('/sign-sub',                'ProfileController@login_submit');

/*  -------------   Check Middleware for create profile  --------------*/ 

Route::group(['middleware' => ['check_create_profile']], function() {

Route::get('/dashboard',         'ProfileController@dashboard');

Route::get('/edit-profile',      'ProfileController@edit_profile'); 
Route::post('/update-profile',   'ProfileController@update_profile'); 

/*  -------------   Check instagram  --------------*/ 

Route::get('/instagram',         'ProfileController@get_instagram'); 
Route::get('/callback',          'ProfileController@callback');

/*  -------------   Check twitter  --------------*/ 

Route::get('/twitter',           'ProfileController@get_twitter'); 
Route::get('/twitter-callback',  'ProfileController@get_callback');


Route::get('/get-user-details',  'ProfileController@getUserDetails');

Route::get('signout',            'ProfileController@login_out'); 

});    /*  --------------- End middleware for create profile ----------------*/ 


/*  --------------------Profile  ---------------------*/

Route::get('/sign-sub',             'ProfileController@index');
Route::get('/peopleinfo/{pid}',   'HomeController@index');


/*  -------------------- Search  ---------------------*/

Route::post('/search-profile',       'ProfileController@search_profile');
Route::get('/search-header',         'ProfileController@search_header');
Route::get('/search-home',           'ProfileController@search_home');
Route::get('/search-profile-link',   'ProfileController@click_name_link');



