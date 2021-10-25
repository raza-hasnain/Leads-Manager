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

Route::middleware(['web', 'auth'])->prefix('leads')->group(function() {
    Route::get('/index', 'LeadController@index')->name('leads.index');
    Route::any('/new_lead', 'LeadController@create')->name('leads.add');
    Route::get('/view/{lead_id}', 'LeadController@viewlead')->name('leads.view');
    Route::get('/statist', 'LeadController@statistics')->name('leads.statistics');
    Route::any('/edit/{lead_id}', 'LeadController@edit')->name('leads.edit');
    Route::any('/delete/{lead_id}', 'LeadController@deleteLead')->name('leads.delete');
    Route::get('/chat', 'LeadController@chatbox')->name('leads.chatbox');
	Route::any('editstatus/{lead_id}','LeadController@editLeadStatus')->name('leads.editstatus');
    Route::any('add_summary/{lead_id}','LeadController@addsummary')->name('leads.add_summary');
    Route::any('convert_customer/{lead_id?}','LeadController@ConvertCustomer')->name('leads.convert_customer');
    Route::any('estimates/{module_id}/{module_member_id}','LeadController@getEstimates')->name('leads.estimates');
    Route::any('proposals/{module_id}/{module_member_id}','LeadController@getProposals')->name('leads.proposals');
	// Export Routes
    Route::any('/export_excel_file', 'LeadController@export_excel_file')->name('leads.export_excel_file');
    Route::any('/export_csv_file', 'LeadController@export_csv_file')->name('leads.export_csv_file');
    Route::any('/export_pdf_file', 'LeadController@export_pdf_file')->name('leads.export_pdf_file');
    Route::any('/print_file', 'LeadController@print_file')->name('leads.print_file');
    // Import Routes
    Route::any('/import_file/{file_type_id?}', 'LeadController@import_file')->name('leads.import_file');
    Route::any('/download/{file_type_id?}', 'LeadController@download')->name('leads.download');
     Route::get('/count_lead', 'LeadController@countConvertlead');
      Route::get('/setting', 'LeadController@setting');
     Route::any('/statusedit/{id?}', 'LeadController@add_status')->name('leads.statusedit');
      Route::any('/sourceedit/{id?}', 'LeadController@add_source')->name('leads.sourceedit');
        Route::any('/deletestatus/{id?}', 'LeadController@deletestatus')->name('leads.statusdelete');
          Route::any('/deletesource/{id?}', 'LeadController@deletesource')->name('leads.sourcedelete');
          Route::post('/convert', 'LeadController@convert')->name('leads.convert');

          Route::get('/task/{id}','LeadController@viewTask')->name('lead.task.view');
         Route::get('/task/add/{id}','LeadController@newTask')->name('lead.task.add');
          Route::get('/note/{id}','LeadController@viewNote')->name('lead.note.add');
         Route::get('/reminder/{id}','LeadController@viewReminder')->name('lead.reminder.add');
         Route::get('/reminder/add/{id}','LeadController@newReminder')->name('lead..reminder.new');
           Route::get('/active/{id}','LeadController@viewActive')->name('lead.active.add');
          Route::any('/log_active/{id?}','LeadController@newLogtouch')->name('lead.active.add');
          Route::get('/statistics','LeadController@dasboard_statistics')->name('lead.statistics');
          Route::any('/email_send/{id?}','LeadController@email_send')->name('lead.emailsend');
          Route::get('SendMail/{id?}','LeadController@sendMail')->name('lead.sendmail');
});
