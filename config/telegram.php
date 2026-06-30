<?php

return [

    'bot_token' => env('TELEGRAM_BOT_TOKEN'),

    'default' => env('TELEGRAM_BOT_NAME', 'simrsmu_bot'),

    'bots' => [
        'bot' => [
            'token' => env('TELEGRAM_BOT_TOKEN'),
        ],
    ],

];
