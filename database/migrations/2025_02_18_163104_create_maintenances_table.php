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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->decimal('subtotal', 10, 0);
            $table->decimal('iva', 10, 0);
            $table->decimal('discount_percent', 10, 0)->nullable();
            $table->decimal('discount', 10, 0)->nullable();
            $table->decimal('grand_total', 10, 0);
            $table->enum('status', ['Pendiente', 'Pagada'])->default('Pendiente');
            $table->string('factura')->nullable();
            $table->date('start_date_maintenance')->nullable();
            $table->date('end_date_maintenance')->nullable();
            $table->date('time_recordatory')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
