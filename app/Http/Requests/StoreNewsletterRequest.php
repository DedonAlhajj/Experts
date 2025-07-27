<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsletterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // أو التحكم بصلاحيات الإدخال لاحقًا
    }

    public function rules(): array
    {
        return [
            'title'     => ['required', 'string', 'max:255'],
            'body'      => ['required', 'string'],
            'image' =>['nullable', 'image'],
            'cta_label' => ['nullable', 'string', 'max:80'],
            'cta_url'   => ['nullable', 'url'],
            'send_at'   => ['nullable', 'date'],
            'repeat_type' => 'nullable|in:none,daily,weekly,monthly',
            'repeat_interval' => 'nullable|integer|min:1',
            'next_send_at' => 'nullable|date|after:now',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'يرجى إدخال عنوان النشرة.',
            'body.required' => 'يرجى إدخال محتوى النشرة.',
            'cta_url.url' => 'رابط زر CTA غير صالح.',
            'send_at.date' => 'صيغة وقت الإرسال غير صحيحة.',
        ];
    }
}
