<?php

namespace Database\Seeders;

use App\Models\Word;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordsAndSynonymsTableSeeder extends Seeder
{
    protected static $synonyms = [
        'bad'   => ['awful', 'terrible', 'horrible'],
        'good'  => ['fine', 'excellent', 'great'],
        'very'  => ['really', 'extremely'],
        'hard'  => ['difficult', 'tough', 'challenging'],
        'teach' => ['instruct', 'educate'],
        'test'  => ['exam', 'assessment'],
    ];

    protected static $words = [
        'bad' => [
            'description' => 'of poor quality or a low standard',
            'pos' => 'adjective',
        ],
        'good' => [
            'description' => 'of a high standard',
            'pos' => 'adjective',
        ],
        'very' => [
            'description' => 'in a high degree',
            'pos' => 'adverb',
        ],
        'hard' => [
            'description' => 'done with a great deal of force or strength',
            'pos' => 'adjective',
        ],
        'teach' => [
            'description' => 'impart knowledge to or instruct',
            'pos' => 'verb',
        ],
        'test' => [
            'description' => 'take measures to check the quality, performance, or reliability',
            'pos' => 'noun',
        ],
        "awful" => [
            'description' => 'very bad or unpleasant',
            'pos' => 'adjective',
        ],
        "terrible" => [
            'description' => 'extremely bad or serious',
            'pos' => 'adjective',
        ],
        "horrible" => [
            'description' => 'causing or likely to cause horror; shocking',
            'pos' => 'adjective',
        ],
        "fine" => [
            'description' => 'of very high quality; very good of its kind',
            'pos' => 'adjective',
        ],
        "excellent" => [
            'description' => 'extremely good; outstanding',
            'pos' => 'adjective',
        ],
        "great" => [
            'description' => 'of an extent, amount, or intensity considerably above average',
            'pos' => 'adjective',
        ],
        "really" => [
            'description' => 'in actual fact, as opposed to what is said',
            'pos' => 'adverb',
        ],
        "extremely" => [
            'description' => 'to a very great degree; very',
            'pos' => 'adverb',
        ],
        "difficult" => [
            'description' => 'needing much effort or skill to accomplish',
            'pos' => 'adjective',
        ],
        "tough" => [
            'description' => 'trong enough to withstand adverse conditions',
            'pos' => 'adjective',
        ],
        "challenging" => [
            'description' => 'testing one\'s abilities; demanding',
            'pos' => 'adjective',
        ],
        "educate" => [
            'description' => 'give intellectual, moral, and social instruction to',
            'pos' => 'verb',
        ],
        "instruct" => [
            'description' => 'tell or order someone to do something',
            'pos' => 'verb',
        ],
        "exam" => [
            'description' => 'a detailed inspection or study',
            'pos' => 'noun',
        ],
        "assessment" => [
            'description' => 'the action of assessing someone or something',
            'pos' => 'noun',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function() {
            foreach(static::$words as $word => $chars) {
                DB::table('words')->insert([
                    'name' => $word,
                    'description' => $chars['description'],
                    'pos' => $chars['pos'],
                    'popularity' => rand(1, 5),
                ]);
            }

            foreach(static::$synonyms as $wordName => $synonyms) {
                $word = Word::query()->where('name', $wordName)->first();

                $synonyms = Word::query()->whereIn('name', $synonyms)->pluck('id');

                $word->synonyms()->syncWithPivotValues($synonyms, ['similarity' => $wordName]);
            }
        });
    }
}
