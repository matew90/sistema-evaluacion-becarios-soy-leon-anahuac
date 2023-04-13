<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convocations', function (Blueprint $table) {
            $table->id();
            $table->uuid('conv_uID');
            $table->string('conv_name',125);
            $table->Integer('conv_period');
            $table->date('conv_start_date');
            $table->date('conv_end_date');
            $table->string('conv_email');
            $table->text('conv_porcentage');
            $table->text('conv_comments');
            $table->foreignUuid('sta_uID');
            $table->foreignUuid('created_by')->nullable();
            $table->foreignUuid('updated_by')->nullable();
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
        Schema::dropIfExists('convocations');
    }
}
