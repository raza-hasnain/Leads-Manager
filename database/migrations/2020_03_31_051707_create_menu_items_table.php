<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('menu_id')->unsigned();
            $table->string('title');
            $table->string('route')->nullable();
            $table->string('model_name')->nullable();
            $table->string('icon')->nullable();
            $table->string('parent_id')->nullable();
            $table->integer('module_id')->nullable();
            $table->integer('order');
            $table->string('key')->nullable();

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
        Schema::dropIfExists('menu_items');
    }
}
