<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtps extends Migration
{
    public function up()
    {
        Schema::create('otps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('otp');
            $table->integer('expries');
            $table->string('address')->comment('email, sms, ..');
            $table->integer('type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('otps');
    }
}
