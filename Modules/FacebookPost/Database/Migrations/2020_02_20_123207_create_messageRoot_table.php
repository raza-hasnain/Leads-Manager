<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageRootTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messageroots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('f_uid');
            $table->string('f_pid');
            $table->string('object_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('lead_id')->nullable();
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
        Schema::dropIfExists('messageRoots');
    }
}
