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
        // Al entrar, limpiamos historial (opcional)
        session()->forget('sessions');
        return view('client.resources.assistant.index', [
            'history' => session('assistant.history', [])
        ]);
    }

public function ask(AssistantRequest $request)
{
    try {
        $prompt = $request->validated()['prompt'];

        // 1) Pushear mensaje del usuario al historial
        session()->push('assistant.history', [
            'role'    => 'user',
            'content' => $prompt,
        ]);

        $history = session('assistant.history', []);

        // 2) Preguntar al servicio con prompt + historial
        $res = $this->service->askQuestion($prompt, $history);

        if (! $res['success']) {
            return response()->json([
                'message' => $res['error'],
                'errors'  => ['prompt'=> [$res['error']]],
            ], 422);
        }

        $reply = $res['reply'];

        // 3) Pushear respuesta al historial
        session()->push('assistant.history', [
            'role'    => 'assistant',
            'content' => $reply,
        ]);

        // 4) Devolver JSON
        return response()->json([
            'reply'  => $reply,
            'status' => 'success',
            'history'=> session('assistant.history'),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error interno del servidor',
            'errors' => ['prompt' => ['Ocurrió un error inesperado']]
        ], 500);
    }
}
}