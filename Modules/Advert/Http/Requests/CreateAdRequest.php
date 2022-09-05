<?php

namespace Modules\Advert\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:225',
            'slug' => 'required|max:225',
            'alt' => 'max:225',
            'image' => 'required',
            'status' => 'required',
            // 'url' => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
