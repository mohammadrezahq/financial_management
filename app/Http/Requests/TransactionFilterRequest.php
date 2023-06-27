<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionFilterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date',
            'category_id' => 'nullable|exists:categories,id',
            'type' => ['nullable', Rule::in('expense', 'income')]
        ];
    }
}
