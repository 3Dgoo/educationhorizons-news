<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuardianNewsItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if (empty($this['webTitle']) || empty($this['webUrl'])) {
            return null;
        }

        $publishedAt = Carbon::parse($this['webPublicationDate']);

        return [
            'id' => md5($this['id']),
            'title' => $this['webTitle'],
            'link' => $this['webUrl'],
            'published_at' => $publishedAt,
            'published_at_nice' => $publishedAt->format('d/m/Y'),
            'section_id' => $this['sectionId'],
            'section_name' => $this['sectionName'],
            'publisher' => 'The Guardian',
            'api' => 'The Guardian',
        ];
    }
}
