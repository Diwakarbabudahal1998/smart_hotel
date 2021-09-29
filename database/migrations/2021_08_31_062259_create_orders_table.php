<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('orders', function (Blueprint $table) {
   $table->id();
   $table->unsignedBigInteger('user_id');
   $table->foreign('user_id')->references('id')->on('users')
    ->onDelete('cascade');
   $table->unsignedBigInteger('table_id');
   $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');
   $table->string('status')->default('received');
   $table->string('type');
   $table->string('payment_status')->default('cash');
   $table->string('total_discount')->default(0);
   $table->string('total_tax')->default(0);
   $table->string('total_price');
   $table->string('room')->nullable();
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
  Schema::table('orders', function (Blueprint $table) {
   $table->dropForeign('orders_user_id_foreign');
   $table->dropColumn('user_id');

  });
  Schema::table('orders', function (Blueprint $table) {
   $table->dropForeign('orders_table_id_foreign');
   $table->dropColumn('table_id');

  });
  Schema::dropIfExists('orders');
 }
}