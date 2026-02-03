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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('application_number')->unique();
            $table->decimal('amount', 15, 2); // Jumlah pengajuan
            $table->integer('tenor'); // Tenor (bulan)
            $table->decimal('interest_rate', 5, 2); // Bunga yang dipilih
            $table->string('status')->default('pending'); // pending, approved, rejected, processing
            $table->text('notes')->nullable(); // Catatan dari admin/sistem
            $table->text('applicant_data')->nullable(); // Data pemohon dalam JSON
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
