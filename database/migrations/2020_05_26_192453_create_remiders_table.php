<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remiders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->datetime('start_date');
            $table->integer('assigned');
            $table->integer('module_id');
            $table->integer('module_member_id');
            $table->string('member_type')->nullable();
            $table->tinyInteger('seen')->default(0);

            $table->integer('create_by');
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
        Schema::dropIfExists('remiders');
    }
}
