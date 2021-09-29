<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddonsTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('addons', function (Blueprint $table) {
   $table->id();
   $table->unsignedBigInteger('user_id');
   $table->foreign('user_id')->references('id')->on('users')
    ->onDelete('cascade');
   $table->string('addon_name');
   $table->string('addon_description')->nullable();
   $table->float('addon_amount');
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
  Schema::table('addons', function (Blueprint $table) {
   $table->dropForeign('addons_user_id_foreign');
   $table->dropColumn('table_id');
  });
  Schema::dropIfExists('addons');
 }
}