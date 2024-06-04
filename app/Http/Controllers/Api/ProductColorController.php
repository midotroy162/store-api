<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Http\Resources\ProductColorResource;
use App\Http\Requests\ProductColors\ProductColorStoreRequest;
use App\Services\ProductColorService;

class ProductColorController extends Controller
{
    public $productColorService;
    public function __construct(ProductColorService $productColorService){
        $this->productColorService = $productColorService;
    }
    public function index()
    {
        return $this->productColorService->getAll();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductColorStoreRequest $request)
    {
        $productColor = $this->productColorService->store($request->validated());
            return  response()->json([
            'message' => 'Successfully created product image color',
            'product'=> $productColor,
            ],201);
    }

    public function show($id)
    {
        $productColor=$this->productColorService->getById($id);
        if (!$productColor) {
            return response()->json(['cant find that product'],404);
        }
        $productColor=new ProductColorResource($productColor);
        return response()->json($productColor,200);
    }

    public function update(Request $request, $id)
    {
        $productColor = $this->productColorService->update($id, $request->all());
        $productColor=$this->productColorService->getById($id);
        $productColor = new ProductColorResource($productColor);
        return response()->json([
            'message' => 'Successfully updated product',
            'product'=> $productColor,
            ],201);
    }
    public function delete(Request $request)
    {
        $this->productColorService->delete($request);
          
        return response()->json([
            'message' => 'Successfully deleted product',
            ],204) ;
    }
}
