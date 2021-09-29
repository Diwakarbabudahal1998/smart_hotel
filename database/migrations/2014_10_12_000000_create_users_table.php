<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
           $table->string('username');
            $table->string('hotel_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('gender')->nullable();
            $table->string('image')->nullable();
            $table->date('dateofbirth')->nullable();
            $table->boolean('status')->default(true);
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('national_id_no')->nullable();
            $table->string('national_id_type')->nullable();
            $table->string('phone')->default('######');
            $table->string('verification_code')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
