<?php

namespace App\Repositories;

use App\Models\Word;
use Illuminate\Http\Request;

/**
 * @property Word entity
 */
class WordRepository extends BaseRepository
{
    protected static $orderByOptions = [
        'popularity_asc'    => 'ASC',
        'popularity_desc'   => 'DESC',
        'pos_asc'           => 'ASC',
        'pos_desc'          => 'DESC',
    ];

    public function filter(Request $request)
    {
        return $this->entity->query()
            ->with(['synonyms'])
            ->when($name = $request->input('name'), function($query) use ($name) {
                $query->where('name', 'like', "%$name%");
            })
            ->when($description = $request->input('description'), function($query) use ($description) {
                $query->where('description', 'like', "%$description%");
            })
            ->when($popularity = $request->input('popularity'), function($query) use ($popularity) {
                $query->where('popularity', 'like', "%$popularity%");
            })
            ->when($pos = $request->input('pos'), function($query) use ($pos) {
                $query->where('pos', 'like', "%$pos%");
            })
            ->when(($orderByParameter = $request->input('orderBy')) && array_key_exists($orderByParameter, static::$orderByOptions), function($query) use ($orderByParameter) {
                $query->orderBy(mb_strstr($orderByParameter, '_', true), static::$orderByOptions[$orderByParameter]);
            })
            ->when($similarity = $request->input('similarity'), function($query) use ($similarity) {
                $query->whereHas('synonyms', function($query) use ($similarity) {
                    $query->where('similarity', 'like', "%$similarity%");
                });
            })
            ->get()
        ;
    }
}