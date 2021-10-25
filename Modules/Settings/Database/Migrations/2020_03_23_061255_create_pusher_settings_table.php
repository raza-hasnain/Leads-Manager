<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePusherSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pusher_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pusher_app_key')->unique();
            $table->string('pusher_app_secret')->unique();
            $table->string('pusher_app_id')->unique();
            $table->string('pusher_app_cluster')->unique();
            $table->string('options')->nullable();
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
        Schema::dropIfExists('pusher_settings');
    }
}
