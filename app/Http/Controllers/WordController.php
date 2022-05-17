<?php

namespace App\Http\Controllers;

use App\Repositories\WordRepository;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function search(Request $request, WordRepository $repository)
    {
        return $repository->filter($request);
    }
}
