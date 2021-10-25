<?php

Route::middleware(['web', 'auth'])->prefix('customer')->group(function() {
    Route::get('/index', 'CustomerController@index')->name('customer.index');
    Route::get('/statistics', 'CustomerController@statistics')->name('customer.statistics');
    Route::any('/add_customer', 'CustomerController@create')->name('customer.add');
    Route::any('/view/{customer_id}', 'CustomerController@view')->name('customer.view');
    Route::any('/edit/{customer_id}', 'CustomerController@edit')->name('customer.edit');
    Route::any('/delete/{customer_id}', 'CustomerController@deleteCustomer')->name('customer.delete');
    
    Route::any('/status_update/{customer_id}', 'CustomerController@statusUpdate')->name('customer_status_update');
    Route::any('/import_file/{file_type_id?}', 'CustomerController@import_file')->name('customer.import_file');
    Route::any('/export_excel_file', 'CustomerController@export_excel_file')->name('customer.export_excel_file');
    Route::any('/export_csv_file', 'CustomerController@export_csv_file')->name('customer.export_csv_file');
    Route::any('/export_pdf_file', 'CustomerController@export_pdf_file')->name('customer.export_pdf_file');
    Route::any('/print_file', 'CustomerController@print_file')->name('customer.print_file');
    Route::any('/download/{file_type}', 'CustomerController@download')->name('customer.download');
    Route::get('/test','CustomerController@dasboard_statistics');
    Route::get('/count_customer','CustomerController@countConvertCustomer');
    Route::any('/email_send/{id?}','CustomerController@email_send')->name('customer.emailsend');
    Route::get('/task/{id}','CustomerController@viewTask')->name('customer.task.view');
    Route::get('/task/add/{id}','CustomerController@newTask')->name('customer.task.add');
    Route::get('/note/{id}','CustomerController@viewNote')->name('customer.note.add');
    Route::get('/reminder/{id}','CustomerController@viewReminder')->name('customer.reminder.add');
    Route::get('/reminder/add/{id}','CustomerController@newReminder')->name('customer..reminder.new');
    Route::get('/active/{id}','CustomerController@viewActive')->name('customer.active.add');
    Route::get('SendMail/{id?}','CustomerController@sendMail')->name('customer.sendmail');
    Route::get('SendMail/proposal/{id?}','CustomerController@sendMailpropsoal')->name('customer.sendproposal');
});
