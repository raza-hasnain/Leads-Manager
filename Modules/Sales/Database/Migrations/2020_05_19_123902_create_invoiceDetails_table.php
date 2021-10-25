<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoiceDetails', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id');
            $table->string('refernce_number');
            $table->unsignedInteger('payment_id');
            $table->decimal('amount', 10,2);
            $table->decimal('due', 10,2);
            $table->unsignedInteger('made_by');
            $table->string('title')->nullable();
            $table->string('title_number')->nullable();
            $table->string('swift_no')->nullable();
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
        Schema::dropIfExists('invoiceDetails');
    }
}
