<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'amount' => 'required|integer',
            'type' => ['required', Rule::in(['expense', 'income'])],
            'description' => 'nullable|string|max:1024',
            'category_id' => 'nullable|exists:categories,id'
        ];
    }
}
