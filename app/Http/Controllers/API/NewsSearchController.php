<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class NewsSearchController extends Controller
{
    public function index(Request $request): array
    {
        $search = Str::lower($request->query('search'));

        if (! $search) {
            return null;
        }

        $news = null;

        if (config('news_search.cache.enable')) {
            $news = cache()->remember(
                'news_search_' . $search,
                config('news_search.cache.seconds'),
                function () use ($search) {
                    return $this->retrieveNews($search);
                }
            );
        } else {
            $news = $this->retrieveNews($search);
        }

        return $news;
    }

    private function retrieveNews(string $search): array
    {
        $newsResults = Http::pool(function (Pool $pool) use ($search) {
            foreach (config('news_search.news_feed_classes') as $newsFeedClass) {
                if (app($newsFeedClass)->getApiKey()) {
                    $pools[] = $pool
                        ->as($newsFeedClass)
                        ->get(app($newsFeedClass)->getFullApiUrl($search));
                }
            }

            return $pools;
        });

        return $this->parseNewsResults($newsResults);
    }

    private function parseNewsResults(array $newsResults): array
    {
        $newsItemsCollection = null;

        foreach ($newsResults as $newsFeedClass => $newsResult) {
            if (! $newsResult->successful()) {
                continue;
            }

            $newsItems = app($newsFeedClass)->parseNewsItems($newsResult);

            $newsItemsCollection = $newsItemsCollection ? $newsItemsCollection->merge($newsItems) : $newsItems;
        }

        return collect($newsItemsCollection)
            ->sortBy([
                ['section_id', 'asc'],
                ['published_at', 'desc'],
            ])
            ->values()
            ->all();
    }
}
