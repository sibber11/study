<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'question',
        'answer',
        'topic_id'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
