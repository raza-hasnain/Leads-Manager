<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone_no');
            $table->integer('country_id');
            $table->string('phone_code');
            $table->string('address');
            $table->integer('updated_by');
            $table->string('city');
            $table->string('postal_code');
            $table->string('logo')->nullable();
            $table->string('logo_sm')->nullable();
            $table->string('icons')->nullable();
            $table->string('footer_container');
            $table->string('copy_right');
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
        Schema::dropIfExists('company_settings');
    }
}
