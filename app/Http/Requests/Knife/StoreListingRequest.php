<?php

namespace App\Http\Requests\Knife;

use Illuminate\Foundation\Http\FormRequest;

class StoreListingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'price' => ['required', 'numeric', 'min:0'],
            'knife_id' => ['required', 'exists:knives,id'],
        ];
    }
}
