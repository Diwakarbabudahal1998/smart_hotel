<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomOrderMenusTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('room_order_menus', function (Blueprint $table) {
   $table->id();
   $table->unsignedBigInteger('room_order_id');
   $table->unsignedBigInteger('user_id');
   $table->unsignedBigInteger('menu_id');
   $table->float('quantity');
   $table->string('status');
   $table->string('note')->nullable();
   $table->json('addons')->nullable();
   $table->foreign('room_order_id')->references('id')->on('orders')
    ->onDelete('cascade');
   $table->foreign('user_id')->references('id')->on('users')
    ->onDelete('cascade');
   $table->foreign('menu_id')->references('id')->on('menus')
    ->onDelete('cascade');
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
  Schema::table('room_order_menus', function (Blueprint $table) {
   $table->dropForeign('room_order_menus_user_id_foreign');
   $table->dropColumn('user_id');
   $table->dropForeign('room_order_menus_room_order_id_foreign');
   $table->dropColumn('order_id');
   $table->dropForeign('room_order_menus_menu_id_foreign');
   $table->dropColumn('menu_id');
  });
  Schema::dropIfExists('room_order_menus');
 }
}