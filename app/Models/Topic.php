<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

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

    // scopes

//    protected static function booted()
//    {
//        static::addGlobalScope('type', function (Builder $builder) {
//            $builder->where('type', self::TYPE_TOPIC);
//        });
//    }

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
}
