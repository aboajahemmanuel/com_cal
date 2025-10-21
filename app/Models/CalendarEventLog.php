<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEventLog extends Model
{
    use HasFactory;

    protected $fillable = ['calendar_type', 'event_id'];
}
