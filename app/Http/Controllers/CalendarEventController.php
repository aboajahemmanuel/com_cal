<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalendarEventLog;
use Illuminate\Support\Facades\Log;

class CalendarEventController extends Controller
{
    public function logSaveToCalendar(Request $request)
    {
        $calendarType = $request->input('calendar_type');
        $eventId = $request->input('event_id'); // assuming you're passing this

        // Create a new log entry
        CalendarEventLog::create([
            'calendar_type' => $calendarType,
            'event_id' => $eventId,
        ]);

        return response()->json(['message' => 'Log saved successfully'], 200);
    }
}
