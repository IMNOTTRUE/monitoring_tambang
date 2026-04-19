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
    Schema::create('cache', function (Blueprint $table) {
    $table->string('key')->primary();
    $table->mediumText('value');
    $table->bigInteger('expiration');
});
Schema::create('cache_locks', function (Blueprint $table) {
    $table->string('key')->primary();
    $table->string('owner');
    $table->bigInteger('expiration');
});
Schema::create('cctv', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->string('lokasi');
    $table->text('url');
    $table->timestamps();
});
Schema::create('jobs', function (Blueprint $table) {
    $table->id();
    $table->string('queue');
    $table->longText('payload');
    $table->unsignedTinyInteger('attempts');
    $table->unsignedInteger('reserved_at')->nullable();
    $table->unsignedInteger('available_at');
    $table->unsignedInteger('created_at');
});
Schema::create('notifikasis', function (Blueprint $table) {
    $table->id();
    $table->text('pesan');
    $table->boolean('dibaca')->default(false);
    $table->timestamps();
});
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->rememberToken();
    $table->string('role')->default('user'); // 🔥 FIX DI SINI
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
