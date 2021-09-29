<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->integer('age');
            $table->string('gender');
            $table->double('phone_no');
            $table->string('email');
            $table->string('address');
            $table->string('country');
            $table->string('booking_type');
            $table->date('last_stay');
            $table->integer('total_stay');
            $table->double('total_value');
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::table('guests',function(Blueprint $table){
            $table->dropForeign('guests_user_id_foreign');
            $table->dropColumn('user_id');
           
        });
        Schema::dropIfExists('guests');
    }
}
