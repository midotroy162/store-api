<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;
use App\Http\Requests\Categories\CategoryStoreRequest;
use App\Http\Requests\Categories\CategoryUpdateRequest;
use App\Http\Requests\Categories\CategoryDeleteRequest;
use App\Utils\ImageUpload;

class CategoryController extends Controller
{
     private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        $mainCategories = $this->categoryService->getMainCategories();
        $categories = new CategoryCollection($mainCategories);
        return response()->json($categories);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {

        // if($request->has('image')){
        //     $image = ImageUpload::uploadImage($request->image, 800, 1000, 'category/');
        // }else{
        //     $image = null;
        // }
        // $category = new Category([
        //     "name"=> $request->name,
        //     "slug"=>Str::slug($request->name),
        //     "image"=>$image
        // ]);
        
        // if($category->save()){
        //     return response()->json([
        //     'message' => 'Successfully created category',
        //     'category'=> $category,
        //     ],201);
        // }
        // return response()->json(['there is a problem'],404 );
        $data=$this->categoryService->store($request->validated());
        return response()->json([$data],201 );
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category=Category::with('product')->find($id);
        if (!$category) {
            return response()->json(['cant find that product'],404);
        }
        $category=new CategoryResource($category);
        return response()->json([
            'catagory'=>$category,
        ],200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        // $category = Category::findOrFail($id);
        // if (!$category) {
        //     return response()->json(['cant find that product'],404);
        // }
        // $category->update($request->all());
        // $category = new CategoryResource($category);
        // return response()->json([
        //     'message' => 'Successfully updated category',
        //     'category'=> $category,
        //     ],201);
        $category=$this->categoryService->update($id,$request->validated());
        return response()->json([$category],201 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(CategoryDeleteRequest $request)
    {
        // $category=Category::findOrFail($id);
        // if (!$category) {
        //     return response()->json(['cant find that product'],404);
        // }
        // return $category->delete();
        $data=$this->categoryService->delete($request->validated());
        return response()->json([$data],201 );
    }
}
