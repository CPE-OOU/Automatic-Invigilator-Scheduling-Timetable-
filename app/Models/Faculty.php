<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description']; // Define the fields that are mass assignable

    // Define relationships
    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

}
