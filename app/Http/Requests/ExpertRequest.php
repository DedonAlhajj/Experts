<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category' => 'required|in:experience,certificate,skill,portfolio',
            'title' => 'required|string|max:255',
            'institution' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'attachment_url' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',

        ];
    }
}
