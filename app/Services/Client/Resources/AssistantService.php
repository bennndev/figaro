<?php

namespace App\Services\Client\Resources;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AssistantService
{
    public function askQuestion(string $prompt): array
    {
        try {
            $response = Http::timeout(15)
                ->withHeaders([
                    'Authorization' => 'Bearer '.config('services.deepseek.api_key'),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ])
                ->post(config('services.deepseek.api_url').'/chat/completions', [
                    'model' => 'deepseek-chat',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'Eres Figaro Assistant, especialista en reservas de barbería. '.
                                         'Sé amable y profesional. Responde en español.'
                        ],
                        ['role' => 'user', 'content' => $prompt]
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 500
                ]);

            if ($response->failed()) {
                Log::error('DeepSeek API Error', [
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
                throw new \Exception("Error en el servicio. Inténtalo más tarde.");
            }

            return [
                'success' => true,
                'reply' => $response->json()['choices'][0]['message']['content']
            ];

        } catch (\Exception $e) {
            Log::error('Assistant Service Error: '.$e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}