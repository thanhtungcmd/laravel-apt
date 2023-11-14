<?php

return [
    'channels' => [
        module_name_lower() => [
            'driver' => 'daily',
            'path' => storage_path('dream_paladin/dream_paladin.log'),
            'days' => 60,
        ]
    ]
];
