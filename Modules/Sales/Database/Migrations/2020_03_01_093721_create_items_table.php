<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_id')->unique();
            $table->unsignedInteger('item_category_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('rate', 10, 2);
            $table->string('unit')->nullable();
            $table->unsignedInteger('tax_id_1')->nullable();
            $table->unsignedInteger('tax_id_2')->nullable();
            $table->unsignedInteger('created_by');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('name');
            $table->index('item_category_id');
            $table->index('created_by');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
