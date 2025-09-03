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
            $table->string('name');
            $table->foreignId('account_id')->constrained('accounts', 'id')->onDelete('cascade');
            $table->dateTime('upload_date')->nullable();
            $table->dateTime('start_test_date')->nullable();
            $table->dateTime('end_test_date')->nullable();
            $table->dateTime('acceptation_date')->nullable();
            $table->enum('status', ['In_progress','In_upload', 'In_test', 'Activated', 'Deleted'])->default('In_progress');
            $table->string('testers');
            $table->timestamps();
            $table->softDeletes();
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