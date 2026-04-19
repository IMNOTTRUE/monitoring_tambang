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
    Schema::create('serah_terima', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal');
        $table->text('keterangan');
        $table->string('dokumentasi');
        $table->string('berita_acara');
        $table->boolean('clear')->default(false); // 🔥 status clear
        $table->boolean('ada_kurang')->default(false); // 🔥 ada kekurangan
        $table->decimal('nominal_pembayaran', 15, 2);
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serah_terimas');
    }
};
