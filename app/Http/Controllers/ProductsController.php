<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\ImagesService;
use App\Services\ProductsService;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public $directory = 'products';
    protected ProductsService $productsService;

    protected ImagesService $imagesService;

    public function __construct(ProductsService $productsService, ImagesService $imagesService)
    {
        $this->productsService = $productsService;
        $this->imagesService = $imagesService;
    }
  public function index()
  {
    $products = Product::paginate(5);
    return view('products.index', compact('products'));
  }
  public function create()
  {
    $brands = Brand::all();
    $categories = Category::all();
    return view('products.create', compact('brands', 'categories'));
  }
  public function store(StoreRequest $request)
  {
      $data = $request->validated();

//      Store Product
      $product = $this->productsService->store($data);

//      Store Product Images
      $this->imagesService->storeImages($product, $this->directory, $data['images']);

      return redirect()->route('products.index')->with([ 'message' => 'Product added successfully']);
  }
  public function edit(Product $product)
  {
      $brands = Brand::all();
      $categories = Category::all();
      return view('products.edit', compact('product', 'brands', 'categories'));
  }
    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
//        Update Product
            $this->productsService->update($product, $data);

//         Update Product Images
            if ($request->has('images')) {
                $this->imagesService->storeImages($product, $this->directory, $data['images']);
            }
            DB::commit();

            return redirect()->route('products.index')->with([
                'message' => 'Product Updated Successfully']);
        } catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with([
                'message' => $e->getMessage()]);
        }
    }
  public function destroy(Product $product)
  {
      $this->imagesService->deleteImages($product);
      $this->productsService->destroy($product);
      return response()->json([
          'message' => 'Product deleted successfully'
      ]);
  }
}
