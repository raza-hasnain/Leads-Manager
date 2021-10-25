<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoiceItems', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id');
            $table->unsignedInteger('item_id')->nullable();
            $table->string('description');
            $table->text('long_description')->nullable();
            $table->integer('quantity');
            $table->string('unit')->nullable();
            $table->decimal('rate', 10,2);
            $table->decimal('percentage', 10,2)->nullable();
            $table->decimal('sub_total', 10,2);

             
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoiceItems');
    }
}
