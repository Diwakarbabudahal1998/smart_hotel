<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
         
            $table->string('table_no');
            $table->json('parent_id')->nullable();
            $table->boolean('is_merged')->default(0);
            $table->boolean('is_split')->default(0);
            $table->string('status')->default("empty");
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
        Schema::table('tables',function(Blueprint $table){
            $table->dropForeign('tables_user_id_foreign');
            $table->dropColumn('user_id');
           
        });
        Schema::dropIfExists('tables');
    }
}
