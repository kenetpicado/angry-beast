<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/Event/Index', [
            'events' => auth()->user()->events()
                ->with('model')
                ->latest()
                ->paginate()
        ]);
    }

    public function store(EventRequest $request)
    {
        auth()->user()->events()->create($request->validated());

        return back();
    }

    public function update(EventRequest $request, Event $event)
    {
        $event->update($request->only(['description', 'quantity']));

        return back();
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return back();
    }
}
