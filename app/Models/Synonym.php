<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Synonym extends Model
{
    use HasFactory;

    protected $fillable = [
        'similarity',
    ];

    public function word()
    {
        return $this->belongsToMany(Word::class, 'synonyms');
    }
}
