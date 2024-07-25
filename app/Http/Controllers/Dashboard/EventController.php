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
            'events' => Event::query()
                ->where('user_id', auth()->id())
                ->with('model')
                ->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        auth()->user()->events()->create($request->validated());

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
