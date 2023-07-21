<?php

namespace App\Http\Resources;

use App\Models\Question;
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
        /** @var Question $this */
//        switch ($this->topic->type) {
//            case Topic::TYPE_TOPIC:
//                $chapter = $this->topic->parent;
//                break;
//            case Topic::TYPE_CHAPTER:
//                $chapter = $this->topic;
//                break;
//            default:
//                $chapter = $this->topic;
//        }
        $chapter = $this->topic;
        $course = $chapter->parent;
        $semester = $course->parent;
        $attributes = [
            'id' => $this->id,
            'title' => $this->title,
            'difficulty' => $this->difficulty,
            'read' => $this->users_count,
            'star' => $this->star,
//            'topic' => $this->topic->only('name', 'short_name'),
            'chapter' => $chapter->only('name', 'short_name'),
            'course' => $course->only('name', 'id', 'code'),
            'semester' => $semester->name,
            'years' => $this->years->implode('no', ' '),
        ];
        return $attributes;
    }
}

