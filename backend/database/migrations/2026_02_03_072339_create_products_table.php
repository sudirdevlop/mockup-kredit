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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('interest_rate_min', 5, 2); // Bunga minimum
            $table->decimal('interest_rate_max', 5, 2); // Bunga maksimum
            $table->integer('tenor_min'); // Tenor minimum (bulan)
            $table->integer('tenor_max'); // Tenor maksimum (bulan)
            $table->decimal('amount_min', 15, 2); // Jumlah pinjaman minimum
            $table->decimal('amount_max', 15, 2); // Jumlah pinjaman maksimum
            $table->text('requirements')->nullable(); // Syarat pengajuan
            $table->text('benefits')->nullable(); // Keuntungan
            $table->string('provider'); // Bank/Lembaga penyedia
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
