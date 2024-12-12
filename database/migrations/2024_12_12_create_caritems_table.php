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
        Schema::create('cartitems', function (Blueprint $table) {
            $table->id('CartItemID');
            $table->unsignedBigInteger('CartID');
            $table->unsignedBigInteger('VariantID');
            $table->integer('Quantity');
            $table->timestamps();

            $table->foreign('CartID')->references('CartID')->on('cart');
            $table->foreign('VariantID')->references('VariantID')->on('productvariants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartitems');
    }
};
