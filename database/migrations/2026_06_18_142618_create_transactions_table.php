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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('code')->unique();
            $table->decimal('total_amount', 12, 2);
            $table->enum('status', [
                'pending_payment',
                'waiting_verification',
                'paid',
                'rejected',
                'cancelled',
                'expired',
            ])->default('pending_payment');
            $table->dateTime('payment_deadline')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->dateTime('verified_at')->nullable();
            $table->text('rejected_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
