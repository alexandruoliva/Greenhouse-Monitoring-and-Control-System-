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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//user  login routes
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/logout','Auth\LoginController@userLogout')->name('user.logout');
// admin login routes

Route::get('/admin/login','Auth\AdministratorLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login','Auth\AdministratorLoginController@login')->name('admin.login.submit');

Route::get('/admin', 'AdminController@index')->name('admin.dashboard');

//pentru fisierul de php display la valori ;
Route::get("/admin/display",'AdminController@display')->name('display');

//


//Route pentru logout
Route::Get('/logout', 'Auth\AdministratorLoginController@logout')->name('admin.logout');

//Route pentru controlarea datelor luminii
//getall descendent pentru lumina

Route::get('light','LightC@index')->middleware('auth:admin')->name('light');

//Route::get('/admin/light','AdminController@lumina')->name('light.admin');
//post request de creere a unei date noi
Route::post('/newLight','LightC@newLight');
//update light values
Route::get('/updateLight','LightC@getUpdate');
Route::put('/newLight','LightC@newUpdate');
Route::post('/deleteLight','LightC@deleteLight');


//Route pentru controlarea datelor temperaturi si umiditatii a aerului
Route::get('temp','TempC@index')->middleware('auth:admin')->name('temp');
//post request de creere a unei date noi de umiditate si temperatura
Route::post('/newTemp','TempC@newTemp');
//delete
Route::post('/deleteTemp','TempC@deleteTemp');

//updates
Route::get('/updateTemp','TempC@getUpdate');
Route::put('/newTemp','TempC@newUpdate');



//Soil moisture sensor routes
Route::get('soil','SoilC@index')->middleware('auth:admin')->name('soil');
//Route::get('/admin/light','AdminController@lumina')->name('light.admin');
//post request de creere a unei date noi
Route::post('/newSoil','SoilC@newSoil');
//update light values
Route::get('/updateSoil','SoilC@getUpdate');
Route::put('/newSoil','SoilC@newUpdate');
Route::post('/deleteSoil','SoilC@deleteSoil');

//User management

Route::get('user','UserC@index')->middleware('auth:admin')->name('user');;

//post request de creere a unei date noi
Route::post('/newUser','UserC@newUser');
//update user values
Route::get('/updateUser','UserC@getUpdate');
Route::put('/newUser','UserC@newUpdate');
Route::post('/deleteUser','UserC@deleteUser');

Route::get('chart_view','ChartController@index');


//light view for users

Route::get('lightuser','LightC@index_user')->middleware('auth')->name('lightuser');

//soil moisture view for users

Route::get('soiluser','SoilC@index_user')->middleware('auth')->name('soiluser');

//temp and hum view for users
Route::get('tempuser','TempC@index_user')->middleware('auth')->name('tempuser');


//graph routes for admin
//light
Route::get('grafice/lightgraph','AdminController@lightgraph')->middleware('auth:admin')->name('lightgraph');

//temp
Route::get('grafice/tempgraph','AdminController@tempgraph')->middleware('auth:admin')->name('tempgraph');

//air humidity

Route::get('grafice/humgraph','AdminController@humgraph')->middleware('auth:admin')->name('humgraph');


//soil moisture
Route::get('grafice/moistgraph','AdminController@moistgraph')->middleware('auth:admin')->name('moistgraph');

//pagina de control
Route::get('/control/controlare','AdminController@controlor')->middleware('auth:admin')->name('control');

//graph routes for users


Route::get ('grafice_user/graficlumina','LightC@displaygraph')->middleware('auth')->name('graficlumina');
Route::get ('grafice_user/grafictemperatura','TempC@displaygraphtemp')->middleware('auth')->name('grafictemperatura');
Route::get ('grafice_user/graficumiditate','TempC@displaygraphhum')->middleware('auth')->name('graficumiditate');

Route::get ('grafice_user/umiditatesol','SoilC@displaygraph')->middleware('auth')->name('umiditatesol');



Route::prefix('admin')->group(function() {

// password reset routes list for admin

    Route::post('/password/email', 'Auth\AdministratorForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdministratorForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdministratorResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdministratorResetPasswordController@showResetForm')->name('admin.password.reset');

});


