<?php

namespace App\Http\Controllers\Client\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Client\Resources\BarberService;

class BarberController extends Controller
{
    public function __construct(protected BarberService $service)
    {
        
    }

    public function index()
    {
        $barbers = $this->service->returnAll();
        return view('client.resources.barber.index', compact('barbers'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $barber = $this->service->find($id);
        return view('client.resources.barber.show', compact('barber'));
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
