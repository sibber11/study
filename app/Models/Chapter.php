<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chapter extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasManyThrough(Question::class,Topic::class);
    }
    
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
