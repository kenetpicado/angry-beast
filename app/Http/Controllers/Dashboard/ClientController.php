<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;

class ClientController extends Controller
{
    public function index()
    {
        return inertia("Dashboard/Client/Index", [
            'clients' => Client::select('id', 'name', 'phone')->orderBy('name')->paginate(10)
        ]);
    }

    public function store(ClientRequest $request): RedirectResponse
    {
        Client::create($request->validated());

        return back();
    }

    public function update(ClientRequest $request, Client $client): RedirectResponse
    {
        $client->update($request->validated());

        return back();
    }

    public function destroy(Client $client): RedirectResponse
    {
        $client->delete();

        return back();
    }
}
