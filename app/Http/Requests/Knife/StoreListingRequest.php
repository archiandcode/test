<?php

namespace App\Http\Requests\Knife;

use Illuminate\Foundation\Http\FormRequest;

class StoreListingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'price' => [
                'required',
                'numeric',
                'min:1',
                'regex:/^\d{1,16}(\.\d{1,2})?$/',
            ],
            'knife_id' => ['required', 'exists:knives,id'],
        ];
    }
}
