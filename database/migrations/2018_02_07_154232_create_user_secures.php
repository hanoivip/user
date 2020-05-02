<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSecures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_secures', function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('personal_id')->nullable();
            $table->string('email')->nullable();
            $table->boolean('email_verified')->nullable();
            $table->string('email_validation_token')->nullable();
            $table->timestamp('last_email_validation')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_code')->nullable();
            $table->boolean('phone_verified')->nullable();
            $table->string('pass2')->nullable();
            $table->integer('question')->nullable();
            $table->string('answer')->nullable();
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
        Schema::dropIfExists('user_secures');
    }
}
