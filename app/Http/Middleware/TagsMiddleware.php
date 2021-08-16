<?php

namespace App\Http\Middleware;

use App\Exceptions\ErrorException;
use App\Models\Tag;
use Closure;
use Illuminate\Http\Request;

class TagsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (isset($request->tags)) {
            $lower = array_map('strtolower', $request->tags);
            $tags = Tag::whereIn('name', $lower)->pluck('id')->toArray();
            if (count($request->tags) != count($tags)) {
                throw new ErrorException('No Tag Found');
            }
            $request->merge(['tags' => $tags]);
        }

        return $next($request);
    }
}
