<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CategoryController extends Controller
{
    public function showCategories(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $categories = Category::all();
        if (!$categories) {
            return redirect()->back()->with('message', 'Категории не найдены');
        }
        return view('admin.categories.categories', ['categories' => $categories]);
    }

    public function updateCategory(Request $request, $id): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|max:255|min:3',
        ]);
        $category = Category::query()->find($id);
        if (!$category) {
            return redirect('/admin/categories')->with('message', 'Категория не найдена');
        }
        try {
            $category->update($data);
            $category->save();
            return redirect('/admin/categories')->with('message', 'Успешно обновлено');
        } catch (\Exception $exception) {
            return redirect('/admin/categories')->with('message', 'Произошла ошибка');
        }
    }

    public function createCategory(Request $request): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|max:255|min:3',
        ]);

        try {
            Category::query()->create($data);
            return redirect('/admin/categories')->with('message', 'Успешно создано');
        } catch (\Exception $exception) {
            return redirect('/admin/categories')->with('message', 'Ошибка создания');
        }
    }
}
