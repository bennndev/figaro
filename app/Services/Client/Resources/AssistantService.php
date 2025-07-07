<?php

namespace App\Services\Client\Resources;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Barber;
use App\Models\Service;
use App\Models\Schedule;
use Carbon\Carbon;
class AssistantService
{
        /**
     * Envía el prompt + contexto + últimos intercambios a DeepSeek
     * @param  string  $prompt
     * @param  array   $history  últimos mensajes (role/content)
     */
    public function askQuestion(string $prompt, array $history): array
    {
        // 1) Cargar datos dinámicos de tu barbería
        $barberos  = Barber::all()
            ->map(fn($b) => "{$b->name} ({$b->specialty})")
            ->join(', ');
        $servicios = Service::pluck('name')->join(', ');
        $fechas  = Schedule::pluck('date')
            ->map(fn($d) => $d->format('d/m/Y'))
            ->join(', ');
        $horarios = Schedule::all()
            ->map(fn($s) => 
                Carbon::parse($s->start_time)->format('H:i')
                .' - '.
                Carbon::parse($s->end_time)->format('H:i')
            )
            ->join(', ');
        $soporte_numero = '+51929725033';
        $soporte_link = 'https://wa.me/51929725033';

        // Si el usuario pregunta por soporte, contacto o WhatsApp, responder con el link de soporte
        if (preg_match('/(soporte|contacto|whatsapp|ayuda|n[uú]mero)/i', $prompt)) {
            return [
                'success' => true,
                'reply' => "Puedes contactarnos por WhatsApp aquí: $soporte_link",
            ];
        }

        // 2) Construir el system prompt
        $system = <<<EOT
        Eres Figaro Assistant, asistente virtual de la barbería Figaro.
        Fechas: {$fechas}, Horarios: {$horarios}.
        Barberos disponibles: {$barberos}.
        Servicios: {$servicios}.
        SOPORTE: {$soporte_numero} (WhatsApp: {$soporte_link}).
        Responde en español, de forma clara y profesional.
        EOT;

        // 3) Montar el array de mensajes: system + historial + user actual
        $messages = [];
        $messages[] = ['role' => 'system', 'content' => $system];

        // añadir sólo los últimos N intercambios para no pasarte de tokens
        $tail = array_slice($history, -6);
        foreach ($tail as $m) {
            $messages[] = $m;
        }

        // finalmente añadimos el user prompt
        $messages[] = ['role' => 'user', 'content' => $prompt];

        // 4) Llamar a DeepSeek
        try {
            $resp = Http::timeout(20)
                ->withHeaders([
                    'Authorization' => 'Bearer '.config('services.deepseek.api_key'),
                    'Content-Type'  => 'application/json',
                    'Accept'        => 'application/json'
                ])
                ->post(config('services.deepseek.api_url').'/chat/completions', [
                    'model'       => 'deepseek-chat',
                    'messages'    => $messages,
                    'temperature' => 0.7,
                    'max_tokens'  => 500,
                ]);

            if ($resp->failed()) {
                Log::error('DeepSeek API Error', [
                    'status'   => $resp->status(),
                    'response' => $resp->body()
                ]);
                throw new \Exception("Error en el servicio de IA. Inténtalo más tarde.");
            }

            $reply = $resp->json('choices.0.message.content');

            return [
                'success' => true,
                'reply'   => $reply,
            ];
        } catch (\Exception $e) {
            Log::error('AssistantService Error: '.$e->getMessage());
            return [
                'success' => false,
                'error'   => $e->getMessage(),
            ];
        }
    }
}