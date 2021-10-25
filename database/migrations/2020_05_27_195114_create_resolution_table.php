<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResolutionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resolutions', function (Blueprint $table) {
             $table->increments('id');
        $table->string('name');
        $table->string('icon')->nullable();
        $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('resolutions');
    }
}
