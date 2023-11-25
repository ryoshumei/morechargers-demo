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
            $table->string('email')->unique();
            $table->string('password');
            $table->string('google_id')->nullable(); // nullable Google ID
            $table->string('ip_address');
            $table->dateTime('signup_datetime')->nullable(); // nullable signup datetime
            $table->dateTime('last_login_datetime')->nullable(); // nullable last login datetime
            $table->enum('user_role', ['user', 'provider', 'admin']); // enum for user roles
            $table->enum('account_type', ['anonymous', 'signed_up', 'google']); // enum for account types
            $table->rememberToken();
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
