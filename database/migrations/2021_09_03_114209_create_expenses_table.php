<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('expenses', function (Blueprint $table) {
   $table->id();
   $table->unsignedBigInteger('user_id');
   $table->foreign('user_id')->references('id')->on('users')
    ->onDelete('cascade');
   $table->string('expense_name');
   $table->string('expense_description')->nullable();
   $table->float('expense_amount');
   $table->string('expense_type');
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
  Schema::table('expenses', function (Blueprint $table) {
   $table->dropForeign('expenses_user_id_foreign');
   $table->dropColumn('table_id');
  });
  Schema::dropIfExists('expenses');
 }
}