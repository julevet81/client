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
        Schema::create('account_purchase', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained('purchases', 'id')->cascadeOnDelete();
            $table->foreignId('account_id')->constrained('accounts', 'id')->cascadeOnDelete();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_purchase');
    }
};
