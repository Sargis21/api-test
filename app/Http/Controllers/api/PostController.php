<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\PostIndexRequest;
use App\Http\Requests\PostStoreUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class PostController extends Controller
{

    public function index(PostIndexRequest $request): JsonResource
    {
        return PostResource::collection(Post::with('tag')->offset($request->offset)->limit($request->limit)->get());
    }


    public function store(PostStoreUpdateRequest $request): JsonResource
    {
        return PostResource::collection([Post::postCreate($request)]);

    }


    public function update(PostStoreUpdateRequest $request, Post $post): JsonResource
    {
        return PostResource::collection([Post::postUpdate($request, $post)]);
    }


    public function destroy(Post $post)
    {
        return response()->json(['status' => 200, 'message' => Post::postDelete($post)], 200);
    }
}
