<?php

namespace App\Clients;

use App\Contracts\CatClientInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class CatClient implements CatClientInterface
{

    protected ClientInterface $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function breeds(): array
    {
        $breeds = [];

        $result = $this->request('GET', 'breeds');

        if ($result) {
            foreach ($result as $item) {
                if (!isset($item['image'])) {
                    continue;
                }

                $breeds[] = [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'temperament' => $item['temperament'],
                    'image_url' => $item['image']['url'],
                ];
            }
        }

        return $breeds;
    }

    public function images(string $breedId, string $size = 'thumb'): array
    {
        $images = [];

        $result = $this->request('GET', 'images/search', [
            'query' => [
                'breed_id' => $breedId,
                'size' => $size,
                'order' => 'RANDOM',
                'limit' => 50,
            ],
        ]);

        if ($result) {
            foreach ($result as $item) {
                $images[] = [
                    'id' => $item['id'],
                    'description' => $item['breeds'][0]['description'],
                    'temperament' => $item['breeds'][0]['temperament'],
                    'image_url' => $item['url'],
                ];
            }
        }

        return $images;
    }

    private function request(string $method, string $endpoint, array $options = []): array
    {
        try {
            $response = $this->httpClient->request($method, $endpoint, $options);
            // $response = $response->getBody()->rewind();
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return [];
        }
    }
}
