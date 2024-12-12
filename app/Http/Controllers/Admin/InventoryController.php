<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Inventory\InventoryService;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    protected $inventoryService;

    // Constructor nhận dependency InventoryService
    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    // Hiển thị thông tin kho hàng
    public function index()
    {
        $inventories = $this->inventoryService->getAllInventory(); // Lấy tất cả thông tin kho hàng
        return view('admin.inventory.index', [
            'title' => 'Thông tin kho hàng',
            'inventories' => $inventories
        ]);
    }

    // Thêm thông tin kho hàng
    public function create()
    {
        return view('admin.inventory.create', [
            'title' => 'Thêm thông tin kho hàng'
        ]);
    }

    // Lưu thông tin kho hàng
    public function store(Request $request)
    {
        $this->inventoryService->addInventory($request);
        
        return redirect()->route('inventory.index');
    }

    // Chỉnh sửa thông tin kho hàng
    public function edit(Inventory $inventory)
    {
        return view('admin.inventory.edit', [
            'title' => 'Chỉnh sửa thông tin kho hàng',
            'inventory' => $inventory
        ]);
    }

    // Cập nhật thông tin kho hàng
    public function update(Inventory $inventory, Request $request)
    {
        $this->inventoryService->updateInventory($inventory, $request);

        return redirect()->route('inventory.index');
    }

    // Xóa thông tin kho hàng
    public function destroy(Request $request)
    {
        $this->inventoryService->deleteInventory($request->id);

        return redirect()->route('inventory.index');
    }
}
