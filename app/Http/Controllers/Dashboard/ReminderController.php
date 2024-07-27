<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reminder;

class ReminderController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/Reminder/Index', [
            'reminders' => auth()->user()->reminders()
                ->with('event')
                ->latest('date')
                ->paginate(),
        ]);
    }

    public function destroy(Reminder $reminder)
    {
        $reminder->delete();

        return back();
    }
}
