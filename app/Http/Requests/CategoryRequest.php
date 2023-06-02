<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;


class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|max:500',
        ];
    }

    public function updateImage(Category $category): void
    {
        if ($this->hasFile('image')) {
            $file     = $this->file('image');
            $filename = uniqid() . '.' . $file->extension();
            $file->storeAs($filename, ['disk' => 'public']);
            if ($category->image) {
                //delete old
                Storage::disk('public')->delete($category->image);
            }
            $category->image = $filename;
        }
    }
}
