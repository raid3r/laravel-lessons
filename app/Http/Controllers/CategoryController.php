<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{

    public function index(Request $request): View
    {
        $search = $request->get('search', '');

        $categories = Category::query()
                              ->where('title', 'LIKE', "%$search%")
                              ->get();


        return view(
            'pages.category.index',
            [
                'search' => $search,
                'categories' => $categories,
            ]
        );
    }

    public function create(): View
    {
        return view(
            'pages.category.create'
        );
    }

    public function show(Category $category): View
    {
        return view('pages.category.show', ['category' => $category]);
    }

    // POST /category/store

    public function store(CategoryRequest $request): RedirectResponse
    {
        $category = new Category($request->validated());
        $request->updateImage($category);
        $category->save();

        return redirect(route('category.index'));
    }

    public function edit(Category $category): View
    {
        return view('pages.category.edit', ['category' => $category]);
    }

    // POST /category/1/update
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {

        $category->fill($request->validated());
        $request->updateImage($category);
        $category->save();

        return redirect()->route('category.index');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->image) {
            //delete old
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();

        return redirect()->route('category.index');
    }
}
