<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskStatusRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:1', Rule::unique('task_statuses', 'name')],
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
            'name.unique' => 'Статус с таким именем уже существует',
        ];
    }
}
