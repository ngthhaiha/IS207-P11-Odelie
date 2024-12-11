<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateFormRequest;
use App\Http\Services\Category\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    // Constructor nhận dependency CategoryService
    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }

    // Hiển thị form thêm danh mục
    public function create(){
        return view('admin.category.add', [
            'title' => 'Thêm danh mục mới',
            'categories' => $this->categoryService->getParent() // Lấy danh mục cha
        ]);
    }

    public function store(CreateFormRequest $request){
        $this->categoryService->create($request);
        
        return redirect()->back();
    }

    public function index(){
        return view('admin.category.list', [
            'title' => 'Danh sách danh mục',
            'categories'  => $this->categoryService->getAll()
        ]);
    }

    public function show(Category $category){
        return view('admin.category.edit', [
            'title' => 'Chỉnh Sửa Danh Mục: ' . $category->name,
            'category' => $category,
            'categories' => Category::where('parent_id', 0)->get() // Load danh mục cha
        ]);
    }


    public function update(Category $category, CreateFormRequest $request){
        $data = $request->validated();

        $category->update([
            'name' => $data['name'],
            'parent_id' => $data['parent_id'],
            'isActive' => $data['active']
        ]);

        return redirect('/admin/category/list')->with('success', 'Cập nhật danh mục thành công');
    }


    public function delete(Request $request){
        $category = Category::find($request->id);

        if (!$category) {
            return response()->json(['error' => true, 'message' => 'Danh mục không tồn tại']);
        }

        $category->update(['isActive' => 0]);

        return response()->json(['error' => false, 'message' => 'Xóa danh mục thành công']);
    }


}
