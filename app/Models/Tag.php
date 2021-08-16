<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function post()
    {
        return $this->belongsToMany(Post::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::lower($value);
    }
}
