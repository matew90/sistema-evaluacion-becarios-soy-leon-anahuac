<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->text('us_banner_guid')->after('us_uID')->nullable();
            $table->string('us_banner_id')->after('us_uID')->nullable()->unique();
            $table->foreignUuid('rol_uID')->before('name')->nullable();
            $table->foreignUuid('camp_uID')->before('name')->nullable();
            $table->foreignUuid('ar_uID')->before('name')->nullable();
            $table->foreignUuid('sta_uID')->before('name')->nullable();
            $table->foreignUuid('deg_uID')->before('name')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
