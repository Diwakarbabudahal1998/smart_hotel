<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomOrdersTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('room_orders', function (Blueprint $table) {
   $table->id();
   $table->unsignedBigInteger('user_id');
   $table->foreign('user_id')->references('id')->on('users')
    ->onDelete('cascade');
   $table->unsignedBigInteger('room_id');
   $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
   $table->string('status')->default('reserved');
   $table->string('type');
   $table->string('payment_status')->default('cash');
   $table->string('total_discount')->default(0);
   $table->string('total_tax')->default(0);
   $table->string('total_price');
   $table->string('room_no')->nullable();
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
  Schema::dropIfExists('room_orders');
 }
}