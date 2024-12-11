<?php
namespace App\Http\Services\Category;


use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CategoryService
{
    public function getParent()
    {
        return Category::where('parent_id', 0)->get();
    }

    public function getAll()
    {
        return Category::orderbyDesc('id')->paginate(20);
    }


    public function create($request)
    {
        try {
            Category::create([
                'name' => (string)$request->input('category'),
                'parent_id' => (int)$request->input('parent_id'),
                'isActive' => (string)$request->input('isActive')
            ]);

            Session::flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $category): bool
    {
        if ($request->input('parent_id') != $category->id) {
            $category->parent_id = (int)$request->input('parent_id');
        }

        $category->name = (string)$request->input('name');
        $category->isActive = (string)$request->input('active');
        $category->save();

        Session::flash('success', 'Cập nhật thành công Danh mục');
        return true;
    }
}