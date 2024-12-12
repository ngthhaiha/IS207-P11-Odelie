<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\UploadService;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    protected $upload;

    public function __construct(UploadService $upload)
    {
        $this->upload = $upload;
    }
    
    public function store(Request $request)
    {
        // Kiểm tra xem tệp có được tải lên hay không
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            // Lấy file từ input
            $file = $request->file('file');
            
            // Di chuyển file vào thư mục lưu trữ (public)
            $filePath = $file->store('uploads', 'public');
            dd($filePath);
            
            // Trả về URL của file đã được lưu trữ
            return response()->json([
                'error' => false,
                'url' => Storage::url($filePath)
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Lỗi tải lên tệp'
        ]);
    }
}

