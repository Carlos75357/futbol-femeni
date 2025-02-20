<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ChatGPTService
{

    public static function getChatResponse($question)
    {
        try {
            $client = new Client([
                'base_uri' => 'https://api.openai.com/v1/',
                'headers' => [
                    'Authorization' => 'Bearer ' . config('services.openai.api_key'),
                    'Content-Type' => 'application/json',
                ],
            ]);
            $response = $client->post('chat/completions', [
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => 'Ets un fan del Barça.'],
                        ['role' => 'user', 'content' => $question],
                    ],
                    'max_tokens' => 250,
                ],
            ]);

            $body = json_decode($response->getBody()->getContents(), true);
            $message = '';
            
            foreach ($body['choices'] as $r) {
                if ($r['message']['role'] == 'assistant') {
                    $message .= $r['message']['content'];
                }
            }
            return $message;
        } catch (\Exception $e) {
            Log::error('Error en la resposta de ChatGPT: ' . $e->getMessage());
            return 'Error: No s\'ha pogut obtenir una resposta de ChatGPT.';
        }
    }
}
