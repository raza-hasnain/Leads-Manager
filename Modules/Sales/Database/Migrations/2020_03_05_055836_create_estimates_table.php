<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstimatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->comment('0=estimates,1=proposal');
            $table->string('title');
            $table->string('url_slug');
            $table->string('estimate_number');
            $table->string('reference')->nullable();
            $table->integer('module_id');
            $table->integer('module_member_id')->nullable();
            $table->string('send_to')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_zip_code')->nullable();
            $table->unsignedInteger('shipping_country_id')->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->unsignedInteger('status_id');
            $table->unsignedInteger('sales_agent_id')->nullable();
            $table->text('admin_note')->nullable();
            $table->date('open_date');
            $table->date('expiry_date')->nullable();
            $table->string('show_quantity_as')->nullable();
            $table->decimal('sub_ptotal', 10,2)->nullable();
            $table->unsignedInteger('discount_method_id')->nullable();
            $table->decimal('discount_rate', 10,2)->nullable();
            $table->decimal('discount_total', 10,2)->nullable();
            $table->longText('taxes')->nullable();
            $table->decimal('tax_total', 10,2)->nullable();
            $table->decimal('adjustment', 10,2)->nullable();
            $table->decimal('total', 10,2)->nullable();

            $table->text('client_note')->nullable();
            $table->text('terms_and_condition')->nullable();
            $table->unsignedInteger('invoice_id')->nullable();

            $table->string('accepted_by_first_name')->nullable();
            $table->string('accepted_by_last_name')->nullable();
            $table->string('accepted_by_email')->nullable();
            $table->string('accepted_by_signature')->nullable();
            $table->timestamp('accepted_date')->nullable();  
            $table->unsignedInteger('created_by');          
            
   
            $table->timestamps();
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimates');
    }
}
