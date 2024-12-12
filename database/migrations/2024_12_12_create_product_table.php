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
        Schema::create('products', function (Blueprint $table) {
            $table->id('ProductID');
            $table->unsignedBigInteger('CategoryID');
            $table->string('Name', 200);
            $table->text('Description')->nullable();
            $table->decimal('Price', 10, 2);
            $table->string('ImageURL')->nullable();
            $table->boolean('IsActive')->default(1);
            $table->timestamps();

            $table->foreign('CategoryID')->references('CategoryID')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
