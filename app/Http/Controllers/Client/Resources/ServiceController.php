<?php

namespace App\Http\Controllers\Client\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Client\Resources\ServiceService;

class ServiceController extends Controller
{
    
    public function __construct(protected ServiceService $service)
    {
        
    }

    public function index()
    {
        $services = $this->service->returnAll();
        return view('client.resources.service.index', compact('services'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $service = $this->service->find($id);
        return view('client.resources.service.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
