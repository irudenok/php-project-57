<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get validation rules for the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'status_id' => ['required', 'exists:task_statuses,id'],
            'assigned_to_id' => ['nullable', 'exists:users,id'],
            'label_ids' => ['nullable', 'array'],
            'label_ids.*' => ['exists:labels,id'],
        ];
    }

    /**
     * Get custom validation error messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Это обязательное поле',
            'status_id.required' => 'Это обязательное поле',
            'status_id.exists' => 'Выбранное значение для Статус некорректно',
            'assigned_to_id.exists' => 'Выбранное значение для Исполнитель некорректно',
        ];
    }
}
