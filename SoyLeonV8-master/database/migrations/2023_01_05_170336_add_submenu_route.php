<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubmenuRoute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('submenus', function (Blueprint $table) {
          $table->text('sub_route')->after('sub_name');
          $table->text('sub_slug')->after('sub_route');
          $table->text('sub_bread')->after('sub_slug');
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
