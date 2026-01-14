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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->index('orders_user_id_foreign');
            $table->char('guest_token', 36)->nullable();
            $table->decimal('subtotal', 10);
            $table->decimal('shipping', 10)->default(0);
            $table->decimal('tax', 10)->default(0);
            $table->decimal('discount', 10)->default(0);
            $table->decimal('total', 10);
            $table->string('payment_method')->default('cod');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
