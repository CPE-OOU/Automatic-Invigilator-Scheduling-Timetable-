<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

 protected $fillable = [
    'name',
    'faculty',
    
];

public function lecturers()
    {
        return $this->belongsToMany(Lecturer::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

}
