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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('subtotal', 10, 0);
            $table->decimal('iva', 10, 0);
            $table->decimal('discount', 10, 0)->nullable();
            $table->decimal('grand_total', 10, 0);
            $table->text('note')->nullable();
            $table->enum('status', ['Cotizado', 'Aceptada', 'Rechazada'])->default('Cotizado');
            $table->enum('bussines', ['Ciro', 'Raisa'])->default('Raisa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
