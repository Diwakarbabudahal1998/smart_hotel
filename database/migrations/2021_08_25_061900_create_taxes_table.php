<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("tax_name");
            $table->float("tax_percent");
            $table->string("tax_status")->default("active");
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
        Schema::table('taxes',function(Blueprint $table){
            $table->dropForeign('taxes_user_id_foreign');
            $table->dropColumn('user_id');
           
        });
        Schema::dropIfExists('taxes');
    }
}
