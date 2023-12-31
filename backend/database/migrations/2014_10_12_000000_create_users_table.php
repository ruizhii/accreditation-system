<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'name' => 'programme leader',
                'email' => 'test@gmail.com',
                'password' => '$2y$10$XDmWmZ3/.okOggBgU4lE3uu4rDLJqIy48aiXqw0BP1rJU5O97vn1e'
            )
        );
        DB::table('users')->insert(
            array(
                'name' => 'programme coordinator',
                'email' => 'test2@gmail.com',
                'password' => '$2y$10$XDmWmZ3/.okOggBgU4lE3uu4rDLJqIy48aiXqw0BP1rJU5O97vn1e'
            )
        );
        DB::table('users')->insert(
            array(
                'name' => 'qmec',
                'email' => 'test3@gmail.com',
                'password' => '$2y$10$XDmWmZ3/.okOggBgU4lE3uu4rDLJqIy48aiXqw0BP1rJU5O97vn1e'
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
