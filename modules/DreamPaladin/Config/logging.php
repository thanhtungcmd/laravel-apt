<?php

return [
    'channels' => [
        'dream_paladin' => [
            'driver' => 'daily',
            'path' => storage_path('dream_paladin/dream_paladin.log'),
            'days' => 60,
        ]
    ]
];
