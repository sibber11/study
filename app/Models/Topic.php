<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use Kalnoy\Nestedset\QueryBuilder;

class Topic extends Model
{
    use NodeTrait, HasFactory;

    public $timestamps = false;

    // types
    const TYPE_TOPIC = 'topic';
    const TYPE_CHAPTER = 'chapter';
    const TYPE_COURSE = 'course';
    const TYPE_SEMESTER = 'semester';

    const TYPES = [
        Topic::TYPE_TOPIC,
        Topic::TYPE_CHAPTER,
        Topic::TYPE_COURSE,
        Topic::TYPE_SEMESTER
    ];
    protected $fillable = [
        'name',
        'type',
    ];

    protected $attributes = [
        'type' => self::TYPE_TOPIC,
    ];

//    protected $appends = [
//        'short_name',
//    ];

    protected function shortName(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => Str::limit($attributes['name'], 10),
        );
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function scopeTopic(Builder $query)
    {
        return $query->where('type', self::TYPE_TOPIC);
    }

    public function scopeChapter(Builder $query)
    {
        return $query->where('type', self::TYPE_CHAPTER);
    }

    public function scopeCourse(Builder $query)
    {
        return $query->where('type', self::TYPE_COURSE);
    }

    public function scopeSemester(Builder $query)
    {
        return $query->where('type', self::TYPE_SEMESTER);
    }

    public function scopeUserSemester(QueryBuilder $query)
    {
        if (auth()->check()){
            return $query->whereDescendantOf(auth()->user()->semester_id);
        }
        return $query->when(session('semester_id'), fn($query, $courseId) => $query->whereDescendantOf($courseId));
    }

    public function scopeChapterOfSelectedCourse(QueryBuilder $query)
    {
        return $query->chapter()->when(session('course_id'), fn($query, $courseId) => $query->whereDescendantOf($courseId));
    }

    public function scopeCourseOfSelectedSemester(Builder $query)
    {
        return $query->course()->userSemester();
    }

    public function scopeChapterOfSelectedSemester(Builder $query)
    {
        return $query->chapter()->userSemester();
    }

    public function scopeTopicOfSelectedCourse(QueryBuilder $query)
    {
        return $query->topic()->when(session('course_id'), fn($query, $courseId) => $query->whereDescendantOf($courseId));
    }
}
