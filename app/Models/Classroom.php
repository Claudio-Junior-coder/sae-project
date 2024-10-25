<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    //
    use HasFactory;

    protected $table = 'classes';
    protected $fillable = ['name', 'description', 'grade'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
