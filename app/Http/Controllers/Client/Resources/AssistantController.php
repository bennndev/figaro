<?php

namespace App\Http\Controllers\Client\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Resources\Assistant\AssistantRequest;
use App\Services\Client\Resources\AssistantService;

class AssistantController extends Controller
{
    public function __construct(protected AssistantService $service)
    {
    }

    public function index()
    {
        return view('client.resources.assistant.index');
    }

    public function ask(AssistantRequest $request)
    {
        $validated = $request->validated();
        $response = $this->service->askQuestion($validated['prompt']);

        if (!$response['success']) {
            return response()->json([
                'message' => $response['error'],
                'errors' => [
                    'prompt' => [$response['error']]
                ]
            ], 422);
        }

        return response()->json([
            'reply' => $response['reply'],
            'status' => 'success'
        ]);
         try {
        $response = $this->service->askQuestion($request->prompt);
        
        if (!$response['success']) {
            return response()->json([
                'message' => $response['error'],
                'errors' => ['prompt' => [$response['error']]]
            ], 422);
        }

        return response()->json([
            'reply' => $response['reply'],
            'status' => 'success'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error interno del servidor',
            'errors' => ['prompt' => ['Ocurrió un error inesperado']]
        ], 500);
    }
    }
}