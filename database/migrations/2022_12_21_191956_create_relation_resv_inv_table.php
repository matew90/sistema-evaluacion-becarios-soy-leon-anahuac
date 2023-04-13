<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationResvInvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation_resv_inv', function (Blueprint $table) {
            $table->id();
            $table->uuid('resinv_uID');
            $table->foreignUuid('inv_uID');
            $table->integer('resinv_number');
            $table->foreignUuid('sta_uID');
            $table->foreignUuid('res_uID');
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
        Schema::dropIfExists('relation_resv_inv');
    }
}
