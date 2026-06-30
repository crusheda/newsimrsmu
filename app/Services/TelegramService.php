<?php

namespace App\Services;

use Telegram\Bot\Api;

class TelegramService
{

    protected $telegram;


    public function __construct()
    {
        $this->telegram = new Api(
            env('TELEGRAM_BOT_TOKEN')
        );
    }

    public function answerCallbackQuery($data)
    {
        return $this->telegram->answerCallbackQuery($data);
    }

    public function sendGroup($message)
    {
        return $this->telegram->sendMessage([
            'chat_id'=>env('TELEGRAM_GROUP_ID'),
            'message_thread_id'=>551, // TOPIC FAST RESPON
            'text'=>$message,
            'parse_mode'=>'HTML'
        ]);
    }

    public function sendUser($chatId,$message)
    {
        return $this->telegram->sendMessage([
            'chat_id'=>$chatId,
            'text'=>$message,
            'parse_mode'=>'HTML'
        ]);
    }

    public function sendGroupWithButton(
        $message,
        $tiketId,
        $buttons = []
    )
    {
        return $this->telegram->sendMessage([
            'chat_id'=>env('TELEGRAM_GROUP_ID'),
            'message_thread_id'=>551,
            'text'=>$message,
            'parse_mode'=>'HTML',
            'reply_markup'=>json_encode([
                'inline_keyboard'=>$buttons
            ])
        ]);
    }

    public function editMessageButton(
        $chatId,
        $messageId,
        $text,
        $buttons = []
    )
    {
        $payload = [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $text,
            'parse_mode' => 'HTML',
        ];

        // hanya tambahkan reply_markup kalau ada tombol
        if (!empty($buttons)) {
            $payload['reply_markup'] = json_encode([
                'inline_keyboard' => $buttons
            ]);
        }

        return $this->telegram->editMessageText($payload);
    }
}
