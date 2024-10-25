<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_date', 'end_date'];

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
