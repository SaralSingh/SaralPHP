<?php
use App\Services\Route;

Route::get('/','HomeController','index');
Route::get('/user','UserController','user');
Route::get('/users','UserController','users');
Route::get('/403','ErrorController','forbidden');


Route::get('/register','AccountController','register','guest');
Route::get('/login','AccountController','login','guest');
Route::post('/register','AccountController','registerProcess');
Route::post('/login','AccountController','loginProcess');

Route::get('/dashboard','DashboardController','index','auth');
Route::get('/logout','AccountController','logout','auth');
