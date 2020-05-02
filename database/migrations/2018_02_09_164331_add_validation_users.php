<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValidationUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('last_email_validation')->nullable();
            $table->string('email_validation_token')->nullable();
            $table->boolean('email_verified')->nullable();
            $table->timestamp('last_phone_validation')->nullable();
            $table->string('phone_validation_token')->nullable();
            $table->boolean('phone_verified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_email_validation');
            $table->dropColumn('email_validation_token');
            $table->dropColumn('email_verified');
            $table->dropColumn('last_phone_validation');
            $table->dropColumn('phone_validation_token');
            $table->dropColumn('phone_verified');
        });
    }
}
