<?php

namespace App\Services;

use Microcms\Client;

class MicroCmsService
{
    private Client $httpClient;

    public function __construct()
    {
        $microCmsDomain = env('MICRO_CMS_DOMAIN');
        $microCmsApiKey = env('MICRO_CMS_API_KEY');

        $this->httpClient = new Client(
            $microCmsDomain,
            $microCmsApiKey
        );
    }

    public function getContents(string $contentName): array
    {
        return $this->httpClient->list($contentName)->contents;
    }
}
