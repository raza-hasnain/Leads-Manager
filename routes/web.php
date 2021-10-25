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
if(env('APP_SSL') === 'https'){
 URL::forceScheme(env('APP_SSL'));   
}

Route::get('/', 'Auth\LoginController@index')->name('index');

Route::get('/login/facebook/', 'Auth\LoginController@redirectToFacebookProvider')->name('login.fb');
 
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback')->name('facebook.callback');


Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('country-code/{country_code}','BaseController@ajaxGetCountryCode')->name('ajaxGetCountryCode');
Route::get('/media','HomeController@media')->name('media');
Route::any('/profileSetting','HomeController@profileSetting')->name('profileSetting');
Route::get('/customer_link', 'Auth\LoginController@customer_invite')->name('customer_invite');
Route::get('/lead_link', 'Auth\LoginController@lead_invite')->name('lead_invite');
Route::get('/estimate_link/{estimate_number}', 'LinkController@estimate_link')->name('estimate_link');

// Localization
Route::get('/js/lang.js', function () {
     Cache::forget('lang.js');
    $strings = Cache::rememberForever('lang.js', function () {
        $lang = config('app.locale');
       

        $files   = glob(resource_path('lang/' . $lang . '/*.php'));
        $strings = [];

        foreach ($files as $file) {
            $name           = basename($file, '.php');
            $strings[$name] = require $file;
        }

        return $strings;
    });

    header('Content-Type: text/javascript');
    echo('window.i18n = ' . json_encode($strings) . ';');
    exit();
})->name('assets.lang');

/*task route*/
Route::get('/task/show/{module_id}/{id}/{option?}', 'TasksController@show')->name('task.show');
Route::get('/task/add/{module_id}/{id}/{option?}', 'TasksController@create')->name('task.new');
Route::post('/task/store','TasksController@store')->name('task.store');
Route::any('/task/edit/{id}','TasksController@edit')->name('task.edit');
Route::get('/task/view/{id}','TasksController@view')->name('task.modelview');
Route::get('/task/delete/{id}','TasksController@destroy')->name('task.delete');
Route::get('task/show_own/', 'TasksController@show_own')->name('task.task/show_own');

Route::get('/note/show/{module_id}/{id}/{option?}', 'NoteController@show')->name('note.show');
Route::get('/note/add/{module_id}/{id}/{option?}', 'NoteController@create')->name('note.add');
Route::post('/note/store', 'NoteController@store')->name('note.store');
Route::any('/note/edit/{id}','NoteController@edit')->name('note.edit');
Route::get('/note/delete/{id}','NoteController@destroy')->name('note.delete');

Route::get('/reminder/show/{module_id}/{id}/{option?}', 'RemiderController@show')->name('reminder.show');
Route::get('/reminder/add/{module_id}/{id}/{option?}', 'RemiderController@create')->name('reminder.new');
Route::post('/reminder/add', 'RemiderController@store')->name('reminder.store');
Route::any('/reminder/edit/{id}','RemiderController@edit')->name('reminder.edit');
Route::get('/reminder/view/{id}','RemiderController@view')->name('reminder.modelview');
Route::get('/reminder/delete/{id}','RemiderController@destroy')->name('reminder.delete');
Route::get('/active/new/{module_id}/{id}/{option?}','LogactivetyController@create')->name('active.new');
Route::post('/active/add', 'LogactivetyController@store')->name('active.store');
Route::get('/task/setting','TasksController@setting')->name('task.setting');


Route::any('task/task_statusedit/{id?}','TasksController@add_status')->name('task.add_status');
Route::any('task/task_deletestatus/{id?}', 'TasksController@deletestatus')->name('task.statusdelete');
Route::any('task/prioritie_edit/{id?}','TasksController@add_prioritie')->name('prioritie.add_status');
Route::any('task/prioritie_delete/{id?}', 'TasksController@deleteprioritie')->name('prioritie.statusdelete');
Route::any('task/resolution_edit/{id?}','TasksController@add_resolution')->name('resolution.add_status');
Route::any('task/resolution_delete/{id?}', 'TasksController@deleteresolution')->name('resolution.statusdelete');
Route::any('task/medium_edit/{id?}','TasksController@add_medium')->name('medium.add_status');
Route::any('task/medium_delete/{id?}', 'TasksController@deletemedium')->name('medium.statusdelete');
Route::get('showactivtye', 'LogactivetyController@show')->name('show.activty');

Route::get('link', 'Auth\LoginController@soymlink');


