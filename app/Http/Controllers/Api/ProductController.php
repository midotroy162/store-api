<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Http\Requests\Products\ProductStoreRequest;
use App\Http\Requests\Products\ProductUpdateRequest;
use App\Http\Requests\Products\ProductDeleteRequest;
use App\Utils\ImageUpload;

class ProductController extends Controller
{
    public $productService;
    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }
    public function index()
    {
        $products = new ProductCollection($this->productService->getAll());

        return response()->json($products);
    }

    public function store(ProductStoreRequest $request)
    {
        $product = $this->productService->store($request->validated());
        return  response()->json([
            'message' => 'Successfully created product',
            'product'=> $product,
            ],201);
    }
    public function show($id)
    {
        $product=$this->productService->getById($id);
        if (!$product) {
            return response()->json(['cant find that product'],404);
        }
        $product=new ProductResource($product);
        return response()->json($product,200);
    }
    public function update(ProductUpdateRequest $request, $id)
    {

        $product = $this->productService->update($id, $request->all());
        $product=$this->productService->getById($id);
        $product = new ProductResource($product);
        return response()->json([
            'message' => 'Successfully updated product',
            'product'=> $product,
            ],201);
    }
    public function delete(ProductDeleteRequest $request)
    {
         $this->productService->delete($request);   
        return response()->json([
            'message' => 'Successfully deleted product',
            ],204) ;
    }
}
