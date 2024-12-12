

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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id('InventoryID');
            $table->unsignedBigInteger('ProductID');
            $table->integer('TotalStock');
            $table->integer('RestockThreshold')->default(10);
            $table->timestamp('LastUpdated')->useCurrent();
            $table->timestamps();

            $table->foreign('ProductID')->references('ProductID')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
