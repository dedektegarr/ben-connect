<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use Illuminate\Support\Facades\Log;
use Exception;

class ApiService
{
    protected $client;
    protected $baseUrl;
    protected $headers;

    public function __construct()
    {
        $this->client = new Client(); // Gunakan Guzzle Client
        $this->baseUrl = env('APP_BASE_URL_RSUD');
        $this->headers = [
            'x-username' => env('APP_X_USERNAME'),
            'x-token' => env('APP_X_TOKEN'),
        ];
    }

    public function sendMultipleRequests(array $endpoints)
    {
        try {
            $promises = [];

            foreach ($endpoints as $key => $endpoint) {
                $url = $this->baseUrl . $endpoint;

                // Kirim request secara async (tidak perlu menunggu satu per satu)
                $promises[$key] = $this->client->getAsync($url, [
                    'headers' => $this->headers,
                ]);
            }

            // Tunggu semua request selesai (Promise)
            $responses = Utils::settle($promises)->wait();

            // Olah response
            $result = [];

            foreach ($responses as $key => $response) {
                if ($response['state'] === 'fulfilled') {
                    $body = (string) $response['value']->getBody();
                    $data = json_decode($body, true);

                    // Pastikan data hasil decode adalah array
                    if (!is_array($data)) {
                        Log::error("Invalid JSON response for $key: $body");
                        $result[$key] = null;
                        continue;
                    }

                    // Jika endpoint adalah 'ketersediaan_kamar', filter data
                    if ($key === 'ketersediaan_kamar') {
                        $data = array_map(fn ($item) => [
                            'Kelas_kamar' => $item['NAME_OF_CLASS'] ?? null,
                            'Kapasitas' => $item['cap'] ?? null,
                            'Terisi' => $item['ISI'] ?? null,
                        ], $data);
                    }

                    $result[$key] = $data;
                } else {
                    // Log jika request gagal
                    Log::error("Failed to fetch $key: " . json_encode($response['reason']));
                    $result[$key] = null;
                }
            }

            // Pastikan tidak mengembalikan semua data null
            return !empty(array_filter($result)) ? $result : null;

        } catch (\Throwable $error) {
            Log::error("API request failed: " . $error->getMessage());
            return null;
        }
    }

}

