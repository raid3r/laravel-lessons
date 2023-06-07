<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;


class DonateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title'         => 'required|max:200',
            'description'   => 'required|max:500',
            'target_amount' => 'numeric',
        ];
    }
}
