<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediadetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediadetails', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->integer('pagelist_id')->nullable();
            $table->integer('media_id')->unsigned();
            $table->string('photo_id')->nullable();;
            $table->integer('module_member_id');
            $table->string('module_id')->nullable();
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
        Schema::dropIfExists('mediadetails');
    }
}
