<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyEntry extends Model
{
    protected $table = 'daily_entries'; 
    protected $primaryKey = 'day_id';
    protected $fillable = [
        'day_id',
        'content',
    ];
    use HasFactory;
}
