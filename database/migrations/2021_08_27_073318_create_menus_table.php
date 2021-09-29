<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->float('price');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')
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
        Schema::table('menus',function(Blueprint $table){
            $table->dropForeign('menus_user_id_foreign');
            $table->dropColumn('user_id');
           
        });

        Schema::table('menus',function(Blueprint $table){
            $table->dropForeign('menus_category_id_foreign');
            $table->dropColumn('category_id');
           
        });
        Schema::dropIfExists('menus');
    }
}
