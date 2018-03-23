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

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

// Route::get('form-validation', 'HomeController@formValidation');
//
// Route::post('form-validation', 'HomeController@formValidationPost');

// Route::get('form', function(){
//  //render app/views/form.blade.php
//  return View::make('form');
// });
// Route::post('form-validation', array('before'=>'csrf',function(){
//  //form validation come here
//
// }));
//Route::post('/books', function() {
//    return 'Version B';
//});
//
//Route::get('/books/{id?}', function($id = '') {
//    return 'Version C';
//});
//
//
//Route::get('/books', function() {
//    return 'Version A';
//});
//
//
//Route::get('/book/{id}', function ($id) {
//    return 'You have requested book #' . $id;
//});

Route::get('/', 'HomeController@welcome');

Route::get('/about', 'HomeController@about');

Route::get('/contact', 'HomeController@contact');

Route::get('/', 'CostController@index');

Route::post('/', 'CostController@formValidationPost');

//Route::get('/welcome', function () {
//    return View('welcome');
//});


