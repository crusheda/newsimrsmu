<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    public function analyze($data)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => env('OPENAI_MODEL'),
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Anda adalah coder BPJS yang ahli ICD-10 dan INA-CBG'
                ],
                [
                    'role' => 'user',
                    'content' => "
                        Diagnosa: {$data['diagnosa']}
                        Tindakan: {$data['tindakan']}

                        Output JSON:
                        {
                            \"icd10\": \"\",
                            \"icd9\": \"\",
                            \"potensi_reject\": \"\",
                            \"saran\": \"\"
                        }
                    "
                ]
            ],
            'temperature' => 0.2
        ]);

        return $response->json();
    }
}