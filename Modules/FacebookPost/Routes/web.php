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

Route::middleware(['web', 'auth'])->prefix('facebookpost')->group(function() {


    Route::get('/user', 'FacebookPostController@retrieveUserProfile');
     Route::get('/text-post', 'FacebookPostController@index')->name('facebook.text_post');
    Route::get('/photo-post', 'FacebookPostController@index')->name('facebook.image_post');
      Route::post('/post', 'FacebookPostController@post')->name('facebook.post');
       Route::get('/link_post', 'FacebookPostController@link_post')->name('facebook.link_post');
    Route::get('/fb_timeline/{page?}/{id?}', 'FacebookPostController@fb_timeline')->name('facebook.fb_timeline');
    Route::get('/fb_post/{page?}/{id?}', 'FacebookPostController@showPost')->name('facebook.fb_post');
    Route::any('/settings', 'FacebookPostController@settings')->name('facebook.settings');
     Route::post('/submitLinkpost', 'FacebookPostController@submitLinkpost')->name('facebook.submitLinkpost');
     Route::get('/comments/{key}', 'FacebookPostController@readComment')->name('facebook.comments');
     Route::post('/commentspost', 'FacebookPostController@postComment')->name('facebook.commentspost');
    Route::get('/showreplycomments/{id}/{postid}', 'FacebookPostController@replyshowComment')->name('facebook.showreplycomments');
    Route::post('/privateCommentspost', 'FacebookPostController@replyprivateComment')->name('facebook.privateCommentspost');
       Route::get('/test', 'FacebookPostController@replyprivateMessage')->name('facebook.test');
       Route::get('/showMessage/{id}/{name}/{postid}', 'FacebookPostController@showPrivteMessage')->name('facebook.showMessage');
         Route::get('/fbReport/{start?}/{end?}', 'FacebookPostController@showReport')->name('facebook.showReport');
         
              Route::get('/showMessagelead/{id?}/{name?}', 'FacebookPostController@showPrivteMessageLead')->name('facebook.showMessagelead');
         Route::get('/delete/{id}', 'FacebookPostController@postdelete');

});

   Route::get('facebookpost/message', 'FacebookPostController@storeMessage')->name('facebook.webhook');
  
Route::post('facebookpost/message', 'FacebookPostController@storeMessage');
  
