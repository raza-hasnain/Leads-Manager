<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emailsettings', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->string('driver');
            $table->string('host');
            $table->string('port',10);
            $table->string('encryption');
            $table->string('form_address');
            $table->string('form_name');
            $table->string('username');
            $table->string('password');
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
        Schema::dropIfExists('emailsettins');
    }
}
