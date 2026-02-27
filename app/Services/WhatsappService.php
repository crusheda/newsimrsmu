<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected string $token;
    protected string $phoneNumberId;
    protected string $version;
    protected string $baseUrl;

    public function __construct()
    {
        $this->token = config('services.whatsapp.token');
        $this->phoneNumberId = config('services.whatsapp.phone_number_id');
        $this->version = config('services.whatsapp.version', 'v18.0');

        if (!$this->token || !$this->phoneNumberId) {
            throw new \Exception('WhatsApp configuration is missing.');
        }

        $this->baseUrl = "https://graph.facebook.com/{$this->version}/{$this->phoneNumberId}/messages";
    }

    /* =========================================================
     * CORE REQUEST HANDLER (DRY)
     * ========================================================= */
    protected function sendRequest(array $payload)
    {
        $response = Http::withToken($this->token)
            ->post($this->baseUrl, $payload);

        if ($response->failed()) {
            Log::error('WhatsApp API Error', [
                'status' => $response->status(),
                'response' => $response->json()
            ]);
        }

        return $response;
    }

    /* =========================================================
     * SEND TEXT MESSAGE
     * ========================================================= */
    public function sendText(string $to, string $message)
    {
        return $this->sendRequest([
            "messaging_product" => "whatsapp",
            "to" => $to,
            "type" => "text",
            "text" => [
                "body" => $message
            ]
        ]);
    }

    /* =========================================================
     * SEND BUTTON MESSAGE (MAX 3)
     * ========================================================= */
    public function sendButtons(string $to, string $bodyText, array $buttons)
    {
        if (count($buttons) > 3) {
            throw new \InvalidArgumentException("WhatsApp hanya mengizinkan maksimal 3 tombol.");
        }

        $formattedButtons = collect($buttons)->map(function ($btn) {
            return [
                "type" => "reply",
                "reply" => [
                    "id" => $btn['id'],
                    "title" => $btn['title']
                ]
            ];
        })->values()->toArray();

        return $this->sendRequest([
            "messaging_product" => "whatsapp",
            "to" => $to,
            "type" => "interactive",
            "interactive" => [
                "type" => "button",
                "body" => [
                    "text" => $bodyText
                ],
                "action" => [
                    "buttons" => $formattedButtons
                ]
            ]
        ]);
    }

    /* =========================================================
     * SEND LIST MESSAGE (DROPDOWN)
     * ========================================================= */
    public function sendList(string $to, string $bodyText, string $buttonText, array $sections)
    {
        if (empty($sections)) {
            throw new \InvalidArgumentException("Sections tidak boleh kosong.");
        }

        return $this->sendRequest([
            "messaging_product" => "whatsapp",
            "to" => $to,
            "type" => "interactive",
            "interactive" => [
                "type" => "list",
                "body" => [
                    "text" => $bodyText
                ],
                "action" => [
                    "button" => $buttonText,
                    "sections" => $sections
                ]
            ]
        ]);
    }
}
