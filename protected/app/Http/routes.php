<?php
/*
|--------------------------------------------------------------------------
| Front
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/app', function () {
    return view('LG.app');
});
Route::get('/', 'LGController@index');
Route::get('/games-1', 'LGController@games1');
Route::get('/games-2', 'LGController@games2');
Route::get('/games-3', 'LGController@games3');
Route::get('/games-4', 'LGController@games4');
Route::get('/kuesioner-1', 'LGController@kuesioner1');
Route::get('/form', 'LGController@form');
Route::get('/notif', 'LGController@notif');
Route::post('/home/register', 'LGController@register');
Route::post('/home/checkEmail', 'LGController@checkEmail');
Route::post('/home/checkTelp', 'LGController@checkTelp');
Route::post('/home/updatecontact', 'LGController@updatecontact');
Route::get('/store', 'LGController@store');
/*
|--------------------------------------------------------------------------
| CMS
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    
});
