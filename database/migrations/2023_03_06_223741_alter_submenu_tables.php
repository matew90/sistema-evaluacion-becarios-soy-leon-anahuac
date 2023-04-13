<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSubmenuTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('submenus', function (Blueprint $table) {
          $table->boolean('sub_visible')->after('sta_uID')->default(1);
          $table->foreignUuid('sub_parent_uID')->after('sta_uID');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('submenus', function (Blueprint $table) {
          $table->dropColumn('sub_visible');
          $table->dropColumn('sub_parent_uID');
        });
    }
}
