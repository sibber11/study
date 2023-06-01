<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'code',
        'name',
        'semester_id',
    ];

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
