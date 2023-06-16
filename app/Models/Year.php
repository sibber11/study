<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'no',
    ];

    // relations

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
}
