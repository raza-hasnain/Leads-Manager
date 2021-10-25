<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description');
            $table->integer('priorities_id');
            $table->integer('status_id');
            $table->datetime('start_date');
            $table->datetime('deadline');
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
        Schema::dropIfExists('tasks');
    }
}
