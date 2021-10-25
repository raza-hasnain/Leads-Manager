<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postlists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('post_id')->unique();
            $table->text('message')->nullable();
            $table->string('link')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('button_type')->nullable();
            $table->integer('page_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('status');
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
        Schema::dropIfExists('postlists');
    }
}
