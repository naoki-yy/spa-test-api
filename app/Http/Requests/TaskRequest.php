<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'deadLine' => ['required', 'regex:/^\d{4}-\d{2}-\d{2}$/', 'after_or_equal:today']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'タスク名は必須です。',
            'deadLine.required' => '期限は必須です。',
            'deadline.after_or_equal' => '期限は今日以降の日付を指定してください。',
        ];
    }
}
