<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KnifeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'knife_type_id' => ['required', 'exists:knife_types,id'],
            'image' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
