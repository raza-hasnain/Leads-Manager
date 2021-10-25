<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogactivetiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logactiveties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('module_id');
            $table->integer('module_member_id');
            $table->string('member_type')->nullable();
            $table->string('medium_id');
            $table->integer('resolation_id');
            $table->text('description');
             $table->datetime('date');

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
        Schema::dropIfExists('logactiveties');
    }
}
