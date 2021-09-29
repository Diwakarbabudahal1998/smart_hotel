<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('guest_id');
            $table->date('checked_in');
            $table->date('checked_out');
            $table->float('rate');
            $table->string('extras')->nullable();
            $table->float('total_amount');
            $table->string('status');
            $table->string('payment_status');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');
            $table->foreign('guest_id')->references('id')->on('guests')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign('bookings_user_id_foreign');
            $table->dropColumn('user_id');
           });

           Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign('bookings_guest_id_foreign');
            $table->dropColumn('guest_id');
           });
        Schema::dropIfExists('bookings');
    }
}
