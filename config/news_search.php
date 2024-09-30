<?php

return [
    'cache' => [
        'enable' => env('NEWS_SEARCH_CACHE_ENABLE', true),
        'seconds' => env('NEWS_SEARCH_CACHE_SECONDS', 900),
    ],

    'guardian' => [
        'api_key' => env('NEWS_SEARCH_GUARDIAN_API_KEY'),
    ],

    'news_feed_classes' => [
        'App\Actions\GuardianNewsFeed',
    ],
];
