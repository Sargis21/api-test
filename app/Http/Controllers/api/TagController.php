<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagStoreRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Traits\UniqueTagTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class TagController extends Controller
{

    use UniqueTagTrait;

    public function index(): JsonResource
    {
        return TagResource::collection(Tag::all());
    }


    public function store(TagStoreRequest $request): JsonResource
    {
        return TagResource::collection([Tag::create(['name' => Str::lower($request->name)])]);
    }


    public function update(Request $request, Tag $tag): JsonResource
    {
        $this->isUnique($request, $tag);
        $tag->update(['name' => Str::lower($request->name)]);
        return TagResource::collection([$tag]);
    }


    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json(['status' => 200, 'message' => 'Tag Deleted'], 200);

    }
}
