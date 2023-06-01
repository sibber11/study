<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'chapter_id',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
