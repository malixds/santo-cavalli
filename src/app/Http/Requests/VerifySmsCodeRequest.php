<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifySmsCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => ['required', 'string', 'regex:/^\+?[1-9]\d{7,14}$/'],
            'code' => ['required', 'string', 'regex:/^\d{4,6}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Номер телефона обязателен.',
            'phone.string' => 'Номер телефона должен быть строкой.',
            'phone.regex' => 'Некорректный формат номера телефона. Используйте формат E.164, например +79991234567.',
            'code.required' => 'Код подтверждения обязателен.',
            'code.string' => 'Код подтверждения должен быть строкой.',
            'code.regex' => 'Код подтверждения должен содержать от 4 до 6 цифр.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('phone')) {
            $normalized = preg_replace('/[\s\-()]/', '', (string) $this->input('phone'));
            $this->merge(['phone' => $normalized]);
        }
    }
}
