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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('status_id')->constrained()->onDelete('cascade');
            $table->string('email');   // copy from account, but editable
            $table->decimal('publication_price', 8, 2);
            $table->decimal('weekly_price', 8, 2);
            $table->decimal('update_price', 8, 2);
            $table->decimal('upload_price', 8, 2)->default(0.00); // New field for upload price
            $table->date('publication_date');
            $table->timestamps();
            $table->softDeletes(); // Optional: if you want to use soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
