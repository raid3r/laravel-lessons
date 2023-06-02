<?php

namespace Modules\Map\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarkerRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'popup_text' => 'required|max:500',
            'lat'        => 'required|numeric',
            'long'       => 'required|numeric',
        ];
    }
}
