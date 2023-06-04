<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'value',
        'topic_id'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function chapter(){
        return $this->topic->chapter();
    }
    
    public function course()
    {
        return $this->chapter->course();
    }

    public function semester()
    {
        return $this->course->semester(); 
    }
}
