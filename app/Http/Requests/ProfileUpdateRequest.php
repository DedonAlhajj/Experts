<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],

            'phone' => ['nullable', 'string', 'max:20'],
            'is_expert' => ['nullable', 'boolean'],
            'is_job_seeker' => ['nullable', 'boolean'],
            'bio' => ['nullable', 'string'],
            'gender' => ['nullable', 'in:male,female,other'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'country' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'available_for_remote' => ['nullable', 'boolean'],

            // ملف الصورة
            'profile_image' => ['nullable', 'file', 'image', 'max:2048'], // 2MB

            // ملف السيرة الذاتية
            'cv_file' => ['nullable', 'file', 'mimes:pdf', 'max:4096'], // 4MB

            // روابط اجتماعية بصيغة JSON (اختياري)
            'social_links' => ['nullable', 'array'],
            'social_links.*' => ['nullable', 'url'],

            // 💡 إضافة حقول JSON الجديدة هنا
            'skills_json' => ['nullable', 'string'],
            'certificates_json' => ['nullable', 'string'],
            'experiences_json' => ['nullable', 'string'],

            'experiences' => ['nullable', 'array'],
            'experiences.*.category' => ['required', 'in:skill,certificate,portfolio,experience'],
            'experiences.*.title' => ['required', 'string', 'max:255'],
        ];
    }


}
