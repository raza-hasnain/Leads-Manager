<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagelistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagelists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('access_token');
            $table->string('f_id');
            $table->string('name');
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('pagelists');
    }
}
