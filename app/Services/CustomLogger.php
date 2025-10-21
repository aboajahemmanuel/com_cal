<?php
namespace App\Services;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class CustomLogger
{
    public static function logAction($action, $status, $details = [])
    {
        Log::create([
            'user_id' => Auth::id(),
            'action'  => $action,
            'status'  => $status,
            'details' => $details,
            'ip'      => request()->ip(),
        ]);
    }
}
