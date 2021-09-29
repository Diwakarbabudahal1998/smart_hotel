<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('company_name');
            $table->string('user_name');
            $table->string('email');
            $table->string('contact');
            $table->string('address');
            $table->float('price');
            $table->string('product_name');
            $table->string('subscription_type');
            $table->string('subscriptions_days');
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
        Schema::table('billings', function (Blueprint $table) {
            $table->dropForeign('billings_user_id_foreign');
            $table->dropColumn('user_id');

        });
        Schema::dropIfExists('billings');
    }
}
