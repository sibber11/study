<?php

namespace App\Http\Resources;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $attributes = [
            'id' => $this->id,
            'name' => $this->name,
        ];
        if ($this->type == Topic::TYPE_TOPIC){
            $chapter = $this->parent;
            $course = $chapter->parent;
            $semester = $course->parent;

            $attributes = array_merge($attributes, [
                'chapter' => $chapter->name,
                'course' => $course->code,
                'semester' => $semester->name,
            ]);
        }

        if ($this->type == Topic::TYPE_CHAPTER){
            $course = $this->parent;
            $semester = $course->parent;
            $attributes = array_merge($attributes, [
                'course' => $course->code,
                'semester' => $semester->name,
            ]);
        }

        if ($this->type == Topic::TYPE_COURSE){
            $semester = $this->parent;
            $attributes = array_merge($attributes, [
                'semester' => $semester->name,
                'code' => $this->code,
            ]);
        }

        return $attributes;
    }
}
