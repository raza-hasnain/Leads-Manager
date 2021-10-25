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

Route::middleware(['web', 'auth'])->prefix('sales')->group(function() {
    

    /*Item Routes*/

    Route::any('items','ItemController@index')->name('items.index');
    Route::any('edititem/{item_id}','ItemController@edititem')->name('items.edit');
    Route::any('createitem','ItemController@createitem')->name('items.create');
    Route::get('deleteitem/{item_id}','ItemController@deleteitem')->name('items.delete');
    // Export Routes
    Route::any('/export_excel_file', 'ItemController@export_excel_file')->name('items.export_excel_file');
    Route::any('/export_csv_file', 'ItemController@export_csv_file')->name('items.export_csv_file');
    Route::any('/export_pdf_file', 'ItemController@export_pdf_file')->name('items.export_pdf_file');
    Route::any('/print_file', 'ItemController@print_file')->name('items.print_file');
    // Import Routes
    Route::any('/import_file/{file_type_id?}', 'ItemController@import_file')->name('items.import_file');
    Route::any('/download/{file_type_id?}', 'ItemController@download')->name('items.download');

    /*Estimate Routes*/

    Route::get('/estimates', 'EstimateController@index')->name('estimates.index');
    Route::get('/estimates/statistics', 'EstimateController@statistics')->name('estimates.statistics');
    Route::get('view_estimate/{estimate_id}','EstimateController@viewEstimate')->name('estimates.view');
    Route::any('edit/{estimate_id}','EstimateController@editEstimate')->name('estimates.edit');
    Route::any('/new_estimate', 'EstimateController@create')->name('estimates.add');
    Route::any('editstatus/{estimate_id}','EstimateController@editEstimateStatus')->name('estimates.estimatestatuschange');
    
    Route::any('/module_find/{module_id}', 'EstimateController@getmodule')->name('estimates.module_find');
    Route::any('/module_member/{module_id}/{member_id}', 'EstimateController@getmodulemember')->name('estimates.module_member_details');
    Route::any('get_item','ItemController@get_item')->name('estimates.get_item');
    Route::any('get_item_details/{item_id}','ItemController@get_item_details')->name('estimates.get_item_details');
    Route::get('download/{estimate_id}','EstimateController@export_pdf')->name('estimates.downloadpdf');
    Route::get('delete/{estimate_id}','EstimateController@deleteEstimate')->name('estimates.delete');
    Route::get('/count_estimate', 'EstimateController@countConvertEstimate');
    
    /*Proposal Routes*/

    Route::get('/proposals', 'ProposalController@index')->name('proposals.index');
    Route::get('/proposals/statistics', 'ProposalController@statistics')->name('proposals.statistics');
    Route::any('/new_proposal', 'ProposalController@create')->name('proposals.add');
    
    Route::get('view_proposal/{proposal_id}','ProposalController@viewProposal')->name('proposals.view');
    Route::any('edit_proposal/{proposal_id}','ProposalController@editProposal')->name('proposals.edit');
    Route::any('editprposalstatus/{proposal_id}','ProposalController@editProposalStatus')->name('proposals.estimatestatuschange');
    Route::get('download/{estimate_id}','EstimateController@export_pdf')->name('estimates.downloadpdf');
    Route::get('delete/{estimate_id}','EstimateController@deleteEstimate')->name('estimates.delete');
    Route::get('/count_estimate', 'EstimateController@countConvertEstimate');
    
    /*Settings Routes*/
    Route::any('settings','ItemController@settings')->name('items.settings');
    Route::any('categories','ItemController@categories')->name('items.categories');
    Route::any('categoriestable','ItemController@viewcategory')->name('items.viewcategories');
    Route::any('editcategory/{item_id}','ItemController@editcategory')->name('items.editcategory');
    Route::any('createcategory','ItemController@createcategory')->name('items.createcategory');
    Route::get('deletecategory/{item_id}','ItemController@deleteitemCategory')->name('items.deletecategory');
     Route::get('setting','EstimateController@setting');
      Route::any('estimate_statusedit/{id?}','EstimateController@add_status')->name('estimate.add_status');
       Route::any('estimate_sourceedit/{id?}','EstimateController@add_source')->name('estimate.add_source');
       
        Route::any('/estimate_deletestatus/{id?}', 'EstimateController@deletestatus')->name('estimate.statusdelete');
          Route::any('/estimate_deletesource/{id?}', 'EstimateController@deletesource')->name('estimate.sourcedelete');
          /*invoice route*/
          Route::get('/invoice', 'InvoiceController@index')->name('invoice.index');
           Route::get('/invoice/statistics', 'InvoiceController@statistics')->name('invoice.statistics');
            Route::any('/new_invoice', 'InvoiceController@create')->name('invoice.add');
             Route::any('/invoice_member/{member_id}', 'InvoiceController@getmodulemember')->name('estimates.module_member_details');
             Route::get('/invoice/showinvoice/{invoice_id}','InvoiceController@viewInvoice')->name('invoice.view');
        Route::get('/invoice/payment/{invoice_id}','InvoiceController@viewPayment')->name('payment.view');
        Route::any('/invoice/add_payment/{invoice_id}','InvoiceController@addPayment')->name('payment.add');
        Route::get('/invoice/task/{invoice_id}','InvoiceController@viewTask')->name('task.view');
         Route::get('/invoice/task/add/{invoice_id}','InvoiceController@newTask')->name('task.add');
          Route::get('/invoice/note/{invoice_id}','InvoiceController@viewNote')->name('note.add');
         Route::get('/invoice/reminder/{invoice_id}','InvoiceController@viewReminder')->name('reminder.add');
         Route::get('/invoice/reminder/add/{invoice_id}','InvoiceController@newReminder')->name('invoice.reminder.new');
         Route::get('/invoice/active/{invoice_id}','InvoiceController@viewActive')->name('active.add');
           Route::get('/invoice/view_payment/{id}','InvoiceController@showPayment')->name('payment.view');

          Route::any('invoice_statusedit/{id?}','InvoiceController@add_status')->name('invoice.add_status');
          Route::any('/invoice_deletestatus/{id?}', 'InvoiceController@deletestatus')->name('invoice.statusdelete');
          Route::any('payment_sourceedit/{id?}','InvoiceController@add_source')->name('payment.add_status');
            Route::any('/payment_deletesource/{id?}', 'InvoiceController@deletesource')->name('payment.statusdelete');
        Route::get('/dasboard_statistics', 'InvoiceController@dasboard_statistics')->name('statistics.invoice');
        Route::any('invoice/edit/{id}','InvoiceController@editInvoice')->name('invoice.edit');
        Route::any('invoice/delete/{id}','InvoiceController@deleteInvoice')->name('invoice.delete');
          Route::any('invoice/status/{id}','InvoiceController@editInvoiceStatus')->name('invoice.status');
   Route::any('invoice/add_status/{id?}','InvoiceController@add_status')->name('invoice.add_status');
   Route::any('invoice/add_payment/{id?}','InvoiceController@add_source')->name('invoice.add_source');
      Route::get('/invoice/pdf/{id}', 'InvoiceController@export_pdf_file')->name('invoice.pdfdownload');
      Route::get('/invoice/print/{id}', 'InvoiceController@print_file')->name('invoice.printdownload');
        Route::get('/invoice/SendMail/{id?}','InvoiceController@sendMail')->name('invoice.sendmail');

});
Route::any('sales/cus_editstatus/{estimate_id}/{status}','EstimateController@editcusEstimateStatus')->name('estimates.estimatecusstatuschange');
Route::get('sales/downloadpdf/{estimate_id}','EstimateController@export_pdf')->name('estimates.downloadcuspdf');
