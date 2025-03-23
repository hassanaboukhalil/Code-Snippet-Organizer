<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    public function snippets()
    {
        return $this->hasMany(Snippet::class);
    }
}
