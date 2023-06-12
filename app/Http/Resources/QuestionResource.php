<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $chapter = $this->topic->parent;
//        dd($this);
        $course = $chapter->parent;
        $semester = $course->parent;

        $attributes = [
            'id' => $this->id,
            'title' => $this->title,
            'topic' => $this->topic->name,
            'chapter' => $chapter->name,
            'course' => $course->code,
            'semester' => $semester->name
        ];
        return $attributes;
    }
}
