<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public $timestamps = false;

    const DIFFICULTIES = [
        0 => 'Easy',
        1 => 'Medium',
        2 => 'Hard'
    ];

    const IMPORTANT = 5;
    const MAX_DIFFICULTY = 2;
    const MAX_STAR = 5;

    protected $fillable = [
        'title',
        'difficulty',
        'star',
        'topic_id'
    ];

    protected $casts = [
        'difficulty' => 'integer',
        'star' => 'integer',
    ];

    protected static function boot()
    {
        // potential bug here may occur when trying to load the question for editing purpose
        parent::boot();
        static::addGlobalScope('course', function ($builder) {
            $builder->whereHas('topic', function ($builder) {
                if (session()->has('course_id'))
                    $builder->where('parent_id', session('course_id'));
            });
        });

        static::creating(function (Question $model){
            $model->star--;
            if ($model->star > static::MAX_STAR){
                $model->star = static::MAX_STAR;
            }
        });
    }
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function years()
    {
        return $this->belongsToMany(Year::class)->orderBy('no');
    }

    protected function difficulty(): Attribute
    {
        return Attribute::make(
            get: fn($value) => self::DIFFICULTIES[$value],
            set: fn($value) => array_search($value, self::DIFFICULTIES)
        );
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'read_user')->where('user_id', auth()->id())->withTimestamps();
    }
    public function read()
    {
        if (!auth()->check()) return;
        $this->users()->attach(auth()->id());
    }
}
