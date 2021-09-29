<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('employee_name');
            $table->string('employee_contact');
            $table->string('employee_address');
            $table->string('employee_email');
            $table->string('employee_id_type');
            $table->string('employee_id_no');
            $table->string('employee_position');
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
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign('employees_user_id_foreign');
            $table->dropColumn('user_id');

        });
        Schema::dropIfExists('employees');
    }
}
