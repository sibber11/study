<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
            'value' => 'required|string|max:255',
            'topic_id' => 'required|integer|exists:topics,id',
            'chapter_id' => 'required|integer|exists:chapters,id',
            'course_id' => 'required|integer|exists:courses,id',
            'semester_id' => 'nullable|integer|exists:semesters,id',
        ];
    }
}
