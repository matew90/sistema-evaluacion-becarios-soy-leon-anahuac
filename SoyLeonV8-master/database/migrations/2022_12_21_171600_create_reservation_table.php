<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->uuid('res_uID');
            $table->text('title');
            $table->date('start');
            $table->date('end');
            $table->time('res_time_start');
            $table->time('res_time_end');
            $table->integer('res_person_number');
            $table->integer('resinv');
            $table->text('res_description');
            $table->foreignUuid('us_uID');
            $table->foreignUuid('sta_uID');
            $table->foreignUuid('spa_uID');
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
        Schema::dropIfExists('reservations');
    }
}
