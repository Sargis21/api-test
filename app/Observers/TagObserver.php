<?php

namespace App\Observers;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagObserver
{

    public function deleted(Tag $tag): void
    {
        DB::table('post_tag')->where('tag_id', $tag->id)->delete();
    }

}
