<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'title'=>'required|string|max:255',
            'description'=>'nullable|string|',
            'priority'=>'required|in:low,medium,high',
            'due_date'=>'nullable|date',
            'tags'=>'nullable|array',
            'tags.*'=>'exists:tags,id'
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'Назва завдання обов\'язкова',
            'title.max'=>'Назва завдання не повинна перевищувати 255 символів',
            'priority_in'=>'Пріорітет повинен бути одним із: low, medium, high',
            'due_date.date'=>'Дата завершення повинна бути конкретною датою',
            'tags.array'=>'Теги повинні бути масивом',
            'tags.*.exists'=>'Один або декілька тегів не існують'

        ];
    }
}
