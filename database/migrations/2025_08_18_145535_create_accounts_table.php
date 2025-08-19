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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->decimal('publication_price', 10, 2)->default(0.00);
            $table->decimal('weekly_price', 10, 2)->default(0.00);
            $table->decimal('update_price', 10, 2)->default(0.00);
            $table->decimal('upload_price', 8, 2);
            $table->timestamps();
            $table->softDeletes(); // Optional: if you want to use soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
