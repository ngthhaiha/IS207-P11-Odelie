<?php


namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function category($categories, $parent_id = 0, $char = '')
{
    $html = '';

    foreach ($categories as $key => $category) {
        if ($category->parent_id == $parent_id) {
            // Tạo các đường dẫn cần thiết
            $editUrl = url('admin/category/edit/' . $category->id);
            $deleteUrl = url('admin/category/delete');

            // Hiển thị danh mục dựa trên trạng thái isActive
            $html .= '
                <tr id="category-' . $category->id . '">
                    <td>' . $category->id . '</td>
                    <td>' . $char . $category->name . '</td>
                    <td>' . self::isActive($category->isActive) . '</td>
                    <td>' . $category->updated_at . '</td>
                    <td>
                        <a href="' . $editUrl . '" class="btn btn-primary btn-sm">Sửa</a>
                        <a href="#" class="btn btn-danger btn-sm"
                           onclick="removeRow(' . $category->id . ', \'' . $deleteUrl . '\')">Xóa</a>
                    </td>
                </tr>
            ';

            // Bỏ danh mục đã được xử lý
            unset($categories[$key]);

            // Đệ quy cho danh mục con
            $html .= self::category($categories, $category->id, $char . '|--');
        }
    }

    return $html;
}

    public static function isActive($isActive)
    {
        return $isActive ? '<span class="badge badge-success">Kích hoạt</span>' 
                         : '<span class="badge badge-danger">Tạm dừng</span>';
    }
}
