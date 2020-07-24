<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class FoursquareCategoriesGetter
 */
class FoursquareCategoriesGetter
{
    private const API_URL = 'https://api.foursquare.com/v2/venues/categories';

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $version;

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * FoursquareCategoriesGetter constructor.
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param string $version
     */
    public function __construct(string $clientId, string $clientSecret, string $version)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->version = $version;
        $this->client = HttpClient::create();
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function get(): array
    {
        $response = $this->client->request('GET', $this->makeUrl());

        return $response->toArray()['response']['categories'];
    }

    private function makeUrl(): string
    {
        $query = http_build_query([
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'v' => $this->version,
        ]);

        return self::API_URL . '?' . $query;
    }

}