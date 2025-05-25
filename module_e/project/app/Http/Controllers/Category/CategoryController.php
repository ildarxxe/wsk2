<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCategories(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::all();
        if (!$categories) {
            return view('admin.categories.categories')->with('message', 'Категории не найдены');
        }
        return view('admin.categories.categories')->with('categories', $categories);
    }

    public function updateCategory(Request $request, $id): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
        ]);
        $category = Category::query()->findOrFail($id);
        try {
            $category->update($data);
            $category->save();
            return redirect()->back()->with('message', 'Успешно обновлено');
        } catch (\Exception $exception) {
            return redirect()->back()->with('message', 'Произошла ошибка');
        }
    }

    public function createCategory(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
        ]);
        try {
            Category::query()->create($data);
            return redirect()->back()->with('message', 'Успешно создано');
        } catch (\Exception $exception) {
            return redirect()->back()->with('message', 'Произошла ошибка');
        }
    }
}
