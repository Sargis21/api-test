<?php

namespace App\Traits;

use App\Exceptions\ErrorException;
use App\Models\Tag;
use Illuminate\Support\Str;

trait UniqueTagTrait
{
    public function isUnique($request, $tag)
    {
        if ($tag->name != Str::lower($request->name))
        {
            if (Tag::where('name', Str::lower($request->name))->exists()) {
                throw new ErrorException('The name has already been taken');
            }
        }


    }
}
