<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\StoreRequest;
use App\Models\Product;
use App\Services\InventoryService;
use Illuminate\Http\JsonResponse;

class InventoryController extends Controller
{
    protected InventoryService $inventoryService;

    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    public function store(StoreRequest $request, Product $product): JsonResponse
    {
        $data = $request->validated();
        $updatedProduct = $this->inventoryService->store($data['quantity'], $product);
          return response()->json([
              'message' => 'Product Stock has been updated',
              'product' => $updatedProduct
          ], 200);
    }
}
