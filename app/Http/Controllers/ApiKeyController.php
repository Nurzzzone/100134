<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class ApiKeyController extends Controller
{
    public function generate()
    {
        $access_token = Str::random(64);
        $expiration = now()->addHour();

        cache()->set($access_token, Uuid::uuid4(), $expiration->diffInSeconds());

        return [
            'access_token' => $access_token,
            'expires_at' => $expiration->toDateTimeString()
        ];
    }
}
