<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstimateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('estimate_id');
            $table->unsignedInteger('item_id')->nullable();
            $table->string('description');
            $table->text('long_description')->nullable();
            $table->integer('quantity');
            $table->string('unit')->nullable();
            $table->decimal('rate', 10,2);
            $table->longText('tax_id')->nullable();
            $table->decimal('sub_total', 10,2);

            $table->index('estimate_id'); 
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
        Schema::dropIfExists('estimate_items');
    }
}
