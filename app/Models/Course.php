<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'credit_hours',
        'user_id',
        'lecturers',
    ];

    public function lecturers()
{
    return $this->belongsToMany(User::class, 'lecturers', 'course_id', 'user_id');
}

}
