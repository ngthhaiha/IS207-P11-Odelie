<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(){
        return view('admin.category.add', [
            'title' => 'Thêm danh mục mới']
            'categories' => $this->categoryService->getParent()
        );
    }
}
