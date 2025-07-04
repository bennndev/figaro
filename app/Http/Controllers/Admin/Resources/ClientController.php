<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Resources\Client\CreateClientRequest;
use App\Http\Requests\Admin\Resources\Client\FilterClientRequest;
use App\Http\Requests\Admin\Resources\Client\UpdateClientRequest;
use App\Services\Admin\Resources\ClientService;

class ClientController extends Controller
{
    public function __construct(protected ClientService $service)
    {
    }

    public function index(FilterClientRequest $request)
    {
        $filters = $request->validated();
        $clients = $this->service->filter($filters);

        return view('admin.resources2.client.index', compact('clients', 'filters'));
    }

    public function create()
    {
        return view('admin.resources2.client.create');
    }

    public function store(CreateClientRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.clients.index')->with('message', 'Cliente creado correctamente.');
    }

    public function show(int $id)
    {
        $client = $this->service->find($id);

        return view('admin.resources2.client.show', compact('client'));
    }

    public function edit(int $id)
    {
        $client = $this->service->find($id);

        return view('admin.resources2.client.edit', compact('client'));
    }

    public function update(UpdateClientRequest $request, int $id)
    {
        $this->service->update($id, $request->validated());

        return redirect()->route('admin.clients.index')->with('message', 'Cliente actualizado correctamente.');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return redirect()->route('admin.clients.index')->with('message', 'Cliente eliminado correctamente.');
    }
}
