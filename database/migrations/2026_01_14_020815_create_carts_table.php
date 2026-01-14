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
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->index('carts_user_id_foreign');
            $table->string('guest_token')->nullable()->index();
            $table->unsignedBigInteger('product_id')->index('carts_product_id_foreign');
            $table->string('item_name');
            $table->string('color_name')->nullable();
            $table->string('size_name')->nullable();
            $table->unsignedBigInteger('size_id')->nullable()->index('carts_size_id_foreign');
            $table->unsignedBigInteger('color_id')->nullable()->index('carts_color_id_foreign');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10)->default(0);
            $table->decimal('total', 10)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
