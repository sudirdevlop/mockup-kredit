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
        Schema::create('credit_simulations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->decimal('loan_amount', 15, 2); // Jumlah pinjaman
            $table->integer('tenor'); // Tenor (bulan)
            $table->decimal('interest_rate', 5, 2); // Bunga
            $table->decimal('monthly_payment', 15, 2); // Cicilan per bulan
            $table->decimal('total_payment', 15, 2); // Total pembayaran
            $table->decimal('total_interest', 15, 2); // Total bunga
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_simulations');
    }
};
