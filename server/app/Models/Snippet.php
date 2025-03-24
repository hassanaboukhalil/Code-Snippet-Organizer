<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\Keyword;
use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'code',
        'language',
        'is_favorite',
        'is_public',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keywords()
    {
        return $this->hasMany(Keyword::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'snippet_tag');
    }
}
