<?php

namespace App\Http\Requests;

use App\Models\Question;
use App\Models\Year;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class StoreMultipleQuestionRequest extends FormRequest
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
            'questions' => 'required_without:questions_array|string',
            'chapter_id' => 'required|exists:topics,id',
            'questions_array' => 'required_without:questions|array',
            'confirmed' => 'required|bool'
        ];
    }

    public function getFormattedData(): array
    {
        $data = preg_replace("/Or,?/m", "1.", $this->input('questions'));
        $data = preg_replace("/\n(\D)/m",' ${1}',$data);
        $data = preg_replace("/^\d+[.)] /m", '', $data);
        $array = explode("\n", $data);
        $formatted = [];
        $counter = 0;
        foreach ($array as $item) {
            if (empty($item)) {
                continue;
            }
            $item = str_replace('][',',',$item);
            preg_match("/[(\[]\d.+[)\]]$/m", $item, $year);
            $years = preg_match_all("/\d{4}|\d{2}/m", $item, $matches);
            $item = str_replace($year, '', $item);
            $item = trim($item);

            if (!str_ends_with($item, '?') && !str_ends_with($item, '.')){
                $item = $item . '.';
            }
            $item = ucfirst($item);
            $years = [];
            foreach ($matches[0] as $year) {
                $year = trim($year);
                if (strlen($year) == 2) {
                    $year = '20' . $year;
                }
                if (!str_starts_with($year, '20')) {
                    continue;
                }
                $years[] = (int)$year;
            }
            $formatted[] = [
                'id' => $counter++,
                'question' => $item,
                'years' => $years,
                'star' => count($years),
            ];
        }
        return $formatted;
    }

    public function store_questions()
    {
        DB::beginTransaction();
        $topic = \App\Models\Topic::find($this->input('chapter_id'));
        $years = Year::all();
        $data = $this->input('questions_array');
        foreach ($data as $item) {
            $question = Question::make([
                'title' => $item['question'],
                'star' => $item['star'],
            ]);
            $question->topic()->associate($topic);
            $question->save();
            $year_ids = $years->whereIn('no', $item['years'])->pluck('id');
            $question->years()->attach($year_ids);
        }
        DB::commit();
    }
}
