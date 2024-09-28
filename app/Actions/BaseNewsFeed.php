<?php

namespace App\Actions;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Str;

abstract class BaseNewsFeed
{
    protected string $type;

    protected string $apiUrl;

    public function getApiKey(): string
    {
        return config('news_search.' . $this->type . '.api_key');
    }

    public function getFullApiUrl(string $search): string
    {
        return Str::replaceArray(
            '%s',
            [
                $this->getApiKey(),
                $search,
            ],
            $this->apiUrl
        );
    }

    abstract public function parseNewsItems(Response $newsItems): array;
}
