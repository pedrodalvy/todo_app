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
            'description' => 'required|min:2|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'task_list_id' => 'required|integer',
            'task_category_id' => 'required|integer',
            'completed' => 'boolean',
        ];
    }
}
