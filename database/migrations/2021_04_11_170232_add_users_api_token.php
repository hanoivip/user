<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddUsersApiToken extends Migration
{
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('api_token', 80)->after('password')
            ->nullable()
            ->default(null);
        });
    }
    
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('api_token');
        });
    }
}
