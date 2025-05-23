<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KnifeTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:knife_types,name'],
        ];
    }
}
