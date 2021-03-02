<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->date('dob');
            $table->integer('class_id');
            $table->string('gender');
            $table->string('father');
            $table->string('mother');
            $table->string('guardian')->nullable();
            $table->string('street');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->string('fmobile');
            $table->string('gmobile')->nullable();
            $table->string('email')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('students');
    }
}
