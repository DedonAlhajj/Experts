<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
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
            'key' => ['required', 'string', 'unique:settings,key'],
            'type' => ['required', 'in:text,email,number,image,boolean,link'],
            'value' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'group' =>['nullable', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }
}
