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
            $table->bigIncrements('ProductID'); // Sử dụng bigIncrements cho primary key
            $table->unsignedBigInteger('CategoryID'); // Đảm bảo khóa ngoại được định nghĩa đúng kiểu
            $table->string('Name', 200); // Giới hạn độ dài chuỗi
            $table->text('Description')->nullable(); // Cho phép null nếu không có mô tả
            $table->decimal('Price', 10, 2); // Giá sản phẩm với định dạng số thực
            $table->string('ImageURL')->nullable(); // Cho phép null nếu không có ảnh
            $table->boolean('IsActive')->default(true); // Sử dụng `true` thay vì `1` cho boolean
            $table->timestamps(); // Thêm các cột `created_at` và `updated_at`

            // Định nghĩa khóa ngoại
            $table->foreign('CategoryID')
                  ->references('CategoryID') // Khóa chính của bảng categories
                  ->on('categories')
                  ->onDelete('cascade'); // Khi xóa danh mục, các sản phẩm liên quan cũng sẽ bị xóa
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products'); // Xóa bảng products nếu tồn tại
    }
};
