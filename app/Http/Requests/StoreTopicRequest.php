<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTopicRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {


        return [
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:topic,chapter,course,semester',
            'semester_id' => 'nullable|required_if:type,course|exists:topics,id',
            'course_id' => 'nullable|required_if:type,chapter|exists:topics,id',
            'chapter_id' => 'nullable|required_if:type,topic|exists:topics,id',
        ];
    }
}
