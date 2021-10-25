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


Route::middleware(['web', 'auth'])->prefix('settings')->group(function() {
    Route::get('/', 'SettingsController@index')->name('settings.index');
    Route::any('/pusher_settings', 'SettingsController@pusher_settings')->name('settings.pusher_settings');
    Route::any('/add_user', 'SettingsController@adduser')->name('settings.add_user');
    Route::any('/edit_user/{id}', 'SettingsController@edituser')->name('settings.edit_user');
    Route::any('user/status_update/{id}', 'SettingsController@statusUpdate')->name('settings.user_statusUpdate');
    Route::any('user/delete_update/{id}', 'SettingsController@deleteUpdate')->name('settings.user_deleteUpdate');
    Route::get('/user_list', 'SettingsController@userlist')->name('settings.user_list');
     Route::get('/showuser_list', 'SettingsController@showuserlist')->name('settings.showadd_user');
     Route::get('/lang_list', 'SettingsController@language')->name('settins.lang_list');
     Route::any('/add_lang', 'SettingsController@addlanguage')->name('settins.add_lang');
     Route::any('/add_lang/active/{id}', 'SettingsController@addlanguageactive')->name('settins.add_langactive');
      Route::any('/translation/{language}', 'SettingsController@translation')->name('settins.translation');
    Route::any('/translation_add', 'SettingsController@translationadd')->name('settins.translation_add');
    Route::any('/translation_update/{language}', 'SettingsController@translationupdate')->name('settins.translation_update');
    Route::get('/country_list_show', 'SettingsController@countryshowlist')->name('settins.country_list_show');
    Route::get('/country_list', 'SettingsController@countrylist')->name('settings.country_list');
     Route::any('/country_modal/{id?}', 'SettingsController@addcountrylist')->name('settings.country_modal');
     Route::any('/time_zone', 'SettingsController@timezone')->name('settings.time_zone');
     Route::any('/email_config', 'SettingsController@emailsetting')->name('settings.email_config');
      Route::any('/app_setting', 'SettingsController@profileSetting')->name('settings.app_setting');
    Route::any('/role_config', 'SettingsController@roleConfig')->name('settings.role_config');
     Route::any('/role_add', 'SettingsController@roleadd')->name('settings.role_add');
     Route::get('/roleList', 'SettingsController@roleList')->name('settings.roleList');
     Route::any('/role_assign', 'SettingsController@roleAssign')->name('settings.role_assign');
      Route::any('/role_edit/{id}', 'SettingsController@roleEdit')->name('settings.role_edit');
      Route::any('/role_delete/{id}', 'SettingsController@deleteRole')->name('settings.deleteRole');
       Route::get('/modulesetting', 'SettingsController@modulesetting')->name('settings.modulesetting');
      
});
