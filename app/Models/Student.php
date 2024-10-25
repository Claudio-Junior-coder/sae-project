<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'responsible_id'];

    public function responsible()
    {
        return $this->belongsTo(Responsible::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function behaviors()
    {
        return $this->hasMany(Behavior::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
