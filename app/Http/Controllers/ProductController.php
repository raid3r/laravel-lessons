<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{

    public function index(Request $request): View
    {
        $search = $request->get('search', '');

        $products = Product::query()->get();


        return view(
            'pages.product.index',
            [
                'search' => $search,
                'products' => $products,
            ]
        );
    }

    public function create(): View
    {
        return view(
            'pages.product.create',
            [
                'categories' => Category::query()->orderBy('title')->get(),
            ]
        );
    }

    public function show(Product $product): View
    {
        return view('pages.product.show', ['product' => $product]);
    }

    // POST /category/store

    public function store(ProductRequest $request): RedirectResponse
    {
        $product = new Product($request->validated());
        $request->updateImage($product);
        $product->save();

        return redirect(route('product.index'));
    }

    public function edit(Product $product): View
    {
        return view('pages.product.edit', ['product' => $product]);
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $product->fill($request->validated());
        $request->updateImage($product);
        $product->save();

        return redirect()->route('product.index');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image) {
            //delete old
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('product.index');
    }
}
