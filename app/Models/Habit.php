<?php

namespace App\Models;
use App\Models\HabitCompletion;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'frequency', 'start_date', 'user_id'];

    public function completions()
    {
        return $this->hasMany(HabitCompletion::class);
    }
}
