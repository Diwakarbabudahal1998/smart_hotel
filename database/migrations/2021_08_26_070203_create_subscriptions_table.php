<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('subscriptions', function (Blueprint $table) {
   $table->id();
   $table->unsignedBigInteger('user_id');
   $table->string('title');
   $table->string('secondary_title');
   $table->text('description');
   $table->float('price');
   $table->string('subscription_type');
   $table->float('subscription_days');
   $table->foreign('user_id')->references('id')->on('users')
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
  Schema::table('subscriptions', function (Blueprint $table) {
   $table->dropForeign('subscriptions_user_id_foreign');
   $table->dropColumn('table_id');

  });
  Schema::dropIfExists('subscriptions');
 }
}