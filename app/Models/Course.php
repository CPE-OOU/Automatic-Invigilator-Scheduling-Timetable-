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
<<<<<<< HEAD
        'user_id',
        'lecturers',
=======
        'lecturers',
        'lecturer', 
>>>>>>> 278825921a3f06e7720e851945cf2eaccf992ec6
    ];

    public function lecturers()
    {
        return $this->belongsToMany(Lecturer::class);
    }
}
