<?php

use App\ISStandard;
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

Route::get('/', 'HomeController@home');

Route::resource('uom', 'UomController');

Route::resource('sample', 'SampleController');
Route::resource('isstandard', 'ISStandardController');
Route::resource('testitem', 'TestItemController');
Route::resource('customer', 'CustomerController')->middleware('auth');

Route::resource('test', 'TestController')->middleware('admin');
Route::get('/drafts', 'TestController@drafts')->middleware('auth')->name('test.drafts');
Route::get('/registerd/tests', 'TestController@registeredTests')->middleware('auth')->name('registered.tests');

Route::get('/test/register/{id}', 'TestController@register')->middleware('auth')->name('test.regsiter');
Route::resource('user', 'UserController');

Route::resource('lab', 'LabController');
Route::post('lab/{id}/user/allocate/', 'LabUserController@allocateUser')->name('allocate.user');
Route::post('lab/{id}/user/remove/', 'LabUserController@removeUser')->name('remove.user');
Auth::routes();

Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard')->middleware('auth');

Route::get('/test/allocate/{id}', 'TestController@allocateView')->name('allocate.get');
Route::post('/test/allocate', 'TestController@allocateAction')->name('allocate');
// Route::get('/report', 'TestController@report')->name('test.report');

Route::get('/jobs/user', 'TestController@myJobs')->name('user.jobs')->middleware('auth');

Route::get('/user/{id}/technician', 'UserController@makeTechnician')->name('user.technician');
Route::get('/user/{id}/employee', 'UserController@makeEmployee')->name('user.employee');

Route::get('/report/{id}', 'TestController@report')->name('test.report');
