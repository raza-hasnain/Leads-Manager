<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrouplistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grouplists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('f_id')->unique();
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
        Schema::dropIfExists('grouplists');
    }
}
