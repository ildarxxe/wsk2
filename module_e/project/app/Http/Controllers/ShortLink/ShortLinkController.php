<?php

namespace App\Http\Controllers\ShortLink;

use App\Http\Controllers\Controller;
use App\Models\ShortLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    public function createLink($id): RedirectResponse
    {
        $link = Str::random(8);
        try {
            ShortLink::query()->create([
                'poll_id' => $id,
                'short_code' => $link
            ]);
            return redirect()->back()->with('message', 'Сгенерированная ссылка: http://127.0.0.1:8000/'.$link);
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'Произошла ошибка');
        }
    }

    public function deleteLink($id): RedirectResponse
    {
        $link = ShortLink::query()->find($id);
        try {
            $link->delete();
            return redirect()->back()->with('message', 'Ссылка удалена');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'Произошла ошибка');
        }
    }
}
