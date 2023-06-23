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
    const MAX_STAR = 3;

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
