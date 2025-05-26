<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    protected $fillable = ['title', 'description', 'frequency', 'start_date', 'user_id'];
}
