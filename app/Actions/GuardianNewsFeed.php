<?php

namespace App\Actions;

use App\Http\Resources\GuardianNewsItemResource;
use Illuminate\Http\Client\Response;

class GuardianNewsFeed extends BaseNewsFeed
{
    protected string $type = 'guardian';

    protected string $apiUrl = 'https://content.guardianapis.com/search?api-key=%s&q=%s';

    public function parseNewsItems(Response $newsItems): array
    {
        return GuardianNewsItemResource::collection($newsItems['response']['results'])->toArray(request());
    }
}
