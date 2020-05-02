<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // credentials
            $table->string('name')->comment('Mandatory, Username, used to to login')->change();
            $table->string('email')->comment('Optional, Email, can be used to login')->nullable()->change();
            $table->string('phone')->unique()->comment('Optional, Phonenumber, can be used to login')->nullable();
            // general info
            $table->string('hoten')->comment('Reallife name. First & last name.')->nullable();
            $table->tinyInteger('sex')->comment('0: male, 1: female, 2: gay, 3: les, 4: unknown')->nullable();
            $table->dateTime('birthday')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('career')->nullable();
            $table->integer('mariage')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
