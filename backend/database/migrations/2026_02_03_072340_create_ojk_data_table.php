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
        Schema::create('ojk_data', function (Blueprint $table) {
            $table->id();
            $table->string('institution_name');
            $table->string('institution_type'); // Bank, Fintech, Lembaga Pembiayaan, dll
            $table->string('registration_number')->unique();
            $table->string('status')->default('active'); // active, inactive, suspended
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->date('registration_date')->nullable();
            $table->text('additional_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ojk_data');
    }
};
