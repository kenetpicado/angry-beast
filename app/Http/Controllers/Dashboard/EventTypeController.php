<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventTypeRequest;
use App\Models\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/EventType/Index', [
            'event_types' => EventType::query()
                ->where('user_id', auth()->id())
                ->select(['id', 'name'])
                ->paginate()
        ]);
    }

    public function store(EventTypeRequest $request)
    {
        auth()->user()->eventTypes()->create($request->validated());

        return back();
    }

    public function show(EventType $eventType)
    {
        return inertia('Dashboard/EventType/Show', [
            'event_type' => $eventType,
            'events' => $eventType->events()->latest()->paginate()
        ]);
    }

    public function update(EventTypeRequest $request, EventType $eventType)
    {
        $eventType->update($request->validated());

        return back();
    }

    public function destroy(EventType $eventType)
    {
        if ($eventType->events()->count()) {
            return back()->withErrors([
                'message' => 'No es posible eliminar porque tiene eventos registrados'
            ]);
        }

        $eventType->delete();

        return back();
    }
}
