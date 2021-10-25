<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messagelists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('message_id')->nullable();
            $table->biginteger('send_id');

            $table->string('message');
            $table->string('time')->nullable();
            $table->integer('messageRoot_id')->unsigned();
            $table->string('seen')->default(0);
            $table->integer('seen_by')->nullable();
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
        Schema::dropIfExists('messageLists');
    }
}
