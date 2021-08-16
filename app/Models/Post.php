<?php

namespace App\Models;

use App\Exceptions\ErrorException;
use App\Helpers\ResponseJson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];


    public static function postCreate($request)
    {
        try {
            DB::beginTransaction();
            $post = self::create($request->all());
            if (self::isTag($request)) $post->tag()->attach($request->tags);
            DB::commit();
            return $post;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ErrorException($e->getMessage());

        }
    }

    public static function postUpdate($request, $post)
    {
        try {
            DB::beginTransaction();
            $post->update($request->all());
            if (self::isTag($request)) $post->tag()->sync($request->tags);
            DB::commit();
            return $post;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ErrorException($e->getMessage());
        }
    }

    public static function postDelete($post)
    {
        try {
            DB::beginTransaction();
            $post->tag()->detach();
            $post->delete();
            DB::commit();
            return 'Post Deleted';
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ErrorException($e->getMessage());
        }
    }

    public static function isTag($request): bool
    {
        return isset($request->tags) ? true : false;
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }
}
