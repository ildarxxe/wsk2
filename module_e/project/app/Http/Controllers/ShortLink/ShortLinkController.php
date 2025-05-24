<?php

namespace App\Http\Controllers\ShortLink;

use App\Http\Controllers\Controller;
use App\Models\ShortLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    public function createShortLink($id): RedirectResponse
    {
        $short_code = Str::random(8);
        ShortLink::query()->create([
            'poll_id' => $id,
            'short_code' => $short_code,
        ]);
        return redirect()->back()->with('message', "Сгенерированная ссылка: http://127.0.0.1:8000/".$short_code);
    }
}
