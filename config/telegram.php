<?php

return [

    'bot_token' => env('TELEGRAM_BOT_TOKEN'),

    'group_id' => env('TELEGRAM_GROUP_ID'),

    'topic_id' => env('TELEGRAM_GROUP_TOPIC_ID'),

    'default' => env('TELEGRAM_BOT_NAME', 'simrsmu_bot'),

    'bots' => [
        'bot' => [
            'token' => env('TELEGRAM_BOT_TOKEN'),
        ],
    ],

];
