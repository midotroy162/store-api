<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reviews\ReviewStoreRequest;
use App\Http\Requests\Reviews\ReviewUpdateRequest;
use App\Http\Resources\ReviewResource;
use App\Services\ReviewService;
use Illuminate\Http\Request;
use App\Models\Review;
class ReviewController extends Controller
{
    public $reviewService;
    public function __construct(ReviewService $reviewService){
        $this->reviewService = $reviewService;
    }
    public function index()
    {
        
    }

    public function store(ReviewStoreRequest $request)
    {
        if (!auth('sanctum')->check()) {
            return  response()->json([
            'message' => 'Please,Login first',
            ],403);
        }
        $reivew = $this->reviewService->store($request->validated());
        return  response()->json([
            'message' => 'Successfully created review',
            'product'=> $reivew,
            ],201);
    }

    public function show($id)
    {
        $reivew=$this->reviewService->getById($id);
        if (!$reivew) {
            return response()->json(['cant find that product'],404);
        }
        $reivew=new ReviewResource($reivew);
        return response()->json($reivew,200);
    }

    public function update(ReviewUpdateRequest $request, $id)
    {
        $review = $this->reviewService->getById($id);
        if(!(auth('sanctum')->user()->id==$review['user_id'])){
            return response()->json([
            'message' => 'not allowed',
            ]);
        }
        $review = $this->reviewService->update($id, $request->all());
        return response()->json([
            'message' => 'Successfully updated product',
            'product'=> $review,
            ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $review = $this->reviewService->getById($request['id']);
        // dd(!(auth('sanctum')->user()->id==$review['user_id']));
        if(!(auth('sanctum')->user()->id==$review['user_id'])){
            return response()->json([
            'message' => 'not allowed',
            ]);
        }
        return $this->reviewService->delete($request);
    }
}
