<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;


class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|max:500',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'category_id' => 'required'
        ];
    }

    public function updateImage(Product $product): void
    {
        if ($this->hasFile('image')) {
            $file     = $this->file('image');
            $filename = uniqid() . '.' . $file->extension();
            $file->storeAs($filename, ['disk' => 'public']);
            if ($product->image) {
                //delete old
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $filename;
        }
    }
}
