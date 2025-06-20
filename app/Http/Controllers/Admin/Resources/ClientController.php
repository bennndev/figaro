<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Services\Admin\Resources\ClientService;

use App\Http\Requests\Admin\Resources\Client\FilterClientRequest;

class ClientController extends Controller
{
    
    public function __construct(protected ClientService $service)
    {
        
    }

    public function index(FilterClientRequest $request)
    {
        $filters = $request->validated();
        $clients = $this->service->filter($filters);

        return view('admin.resources.client.index', compact ('clients', 'filters'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $id)
    {
        
        $client = $this->service->find($id);

        return view('admin.resources.client.show', compact('client'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
