<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserVerifyWays extends Migration
{
    public function up()
    {
        Schema::create('user_verify_ways', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('way')->comment('Type of verification: email, phone, backup codes, authenticator..');
            $table->string('value')->comment('Sms, email. Smart otp & key?');
            $table->boolean('verified')->default(false);
            $table->boolean('delete')->default(false);
            $table->boolean('default')->default(false)->comment('Use this as default verify method');
            $table->tinyInteger('use_count')->default(0)->comment('Usage count');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('user_verify_ways');
    }
}
