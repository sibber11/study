<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
