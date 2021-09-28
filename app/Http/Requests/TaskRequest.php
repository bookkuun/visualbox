<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'task_kind_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'detail' => ['nullable', 'string', 'max:1000'],
            'task_status_id' => ['required', 'integer'],
            'assigner_id' => ['nullable', 'integer'],
            'task_category_id' => ['nullable', 'integer'],
            'task_resolution_id' => ['nullable', 'integer'],
            'due_date' => ['nullable', 'date']
        ];
    }
}
