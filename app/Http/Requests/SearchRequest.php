<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'keyword' => 'nullable|string|max:255',

            'city' => 'nullable|string|max:255',

            'min_price' => 'nullable|numeric|min:0',

            'max_price' => 'nullable|numeric|min:0|gte:min_price',

            'rating' => 'nullable|numeric|min:0|max:5',

            'check_in_date' => 'nullable|date|after_or_equal:today',

            'check_out_date' => 'nullable|date|after:check_in_date',
        ];
    }
}