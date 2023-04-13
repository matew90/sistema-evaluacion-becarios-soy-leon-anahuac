<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->uuid('eval_uID');
            $table->integer('eval_Question1');
            $table->text('eval_Question2');
            $table->text('eval_Question3');
            $table->boolean('eval_Question4');
            $table->text('eval_Question5');
            $table->text('eval_Question6');
            $table->foreignUuid('sta_uID');
            $table->foreignUuid('assig_uID');
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
        Schema::dropIfExists('evaluations');
    }
}
