<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('bill_header');
            $table->string('bill_footer');
            $table->string('printer_size');
            $table->string('printer_name')->nullable();
            $table->boolean('status');
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
        Schema::table('printers',function(Blueprint $table){
            $table->dropForeign('printers_user_id_foreign');
            $table->dropColumn('user_id');
           
        });
        Schema::dropIfExists('printers');
    }
}
