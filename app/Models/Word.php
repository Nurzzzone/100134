<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    public function synonyms()
    {
        return $this->belongsToMany(static::class, 'synonyms', 'word_id', 'synonym_id')
            ->withPivot('similarity');
    }
}
