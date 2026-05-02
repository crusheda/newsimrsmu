<?php

namespace App\Http\Controllers\v4\AI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\OpenAIService;

class KlaimBpjsController extends Controller
{
    function index()
    {
        return view('pages.v4.ai.klaimbpjs.index');
    }

    // public function aiKlaim(Request $request, OpenAIService $ai)
    // {
    //     $result = $ai->analyze([
    //         'diagnosa' => $request->diagnosa,
    //         'tindakan' => $request->tindakan,
    //     ]);
    //     return response()->json($result);
    // }

    public function analyze(Request $request)
    {
        $diagnosa = $request->diagnosa;
        $tindakan = $request->tindakan;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => env('OPENAI_MODEL', 'gpt-4o-mini'),
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Anda adalah coder BPJS. Jawab hanya JSON valid tanpa markdown.'
                ],
                [
                    'role' => 'user',
                    'content' => "
                    Diagnosa: $diagnosa
                    Tindakan: $tindakan
                    Format JSON:
                    {
                        \"icd10\": \"\",
                        \"icd9\": \"\",
                        \"potensi_reject\": \"\",
                        \"saran\": \"\"
                    }
                    "
                ]
            ],
            'temperature' => 0.2,
            'response_format' => ['type' => 'json_object']
        ]);

        $result = $response->json();
        $content = $result['choices'][0]['message']['content'] ?? '';
        $parsed = json_decode($content, true);

        if (!$parsed) {
            return response()->json([
                'error' => 'Format AI tidak valid',
                'raw' => $content
            ]);
        }

        return response()->json($parsed);
    }
}
