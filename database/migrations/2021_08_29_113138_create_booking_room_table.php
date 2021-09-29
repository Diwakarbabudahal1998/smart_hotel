<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_room', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('booking_id')->unsigned();
            $table->bigInteger('room_id')->unsigned();
            $table->timestamps();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_room',function(Blueprint $table){
            $table->dropForeign('booking_room_room_id_foreign');
            $table->dropColumn('room_id');
            $table->dropForeign('booking_room_booking_id_foreign');
            $table->dropColumn('booking_id');
        }); 
        Schema::dropIfExists('booking_room');
    }
}
