<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('password');
        $table->string('remember_token')->nullable(); 
        // Add any other columns you need here
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('password');
        $table->dropColumn('remember_token');
        // Drop any other columns you added
    });
}
};
