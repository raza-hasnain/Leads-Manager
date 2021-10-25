<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lead_id')->unique();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('social_id_link')->nullable();
            $table->string('company')->nullable();
            $table->string('position')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('description')->nullable();
            $table->string('summary')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('lead_status_id')->default('1');
            $table->unsignedInteger('lead_source_id')->default('1');
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('assigned_to')->nullable();
            $table->datetime('last_contacted')->nullable();
            $table->unsignedInteger('last_contacted_by')->nullable();
            $table->tinyInteger('is_lost')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lead_status_id')->references('id')->on('lead_statuses');
            $table->foreign('lead_source_id')->references('id')->on('lead_sources');

            $table->index('lead_id');
            $table->index('first_name');
            $table->index('last_name');
            $table->index('lead_status_id');
            $table->index('lead_source_id');
            $table->index('assigned_to');
            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
