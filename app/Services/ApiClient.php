<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class ApiClient
{
    protected $baseUrl;
    protected $token;
    protected $headers;

    public function __construct($baseUrl, $token = null, $headers = [])
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;
        $this->headers = $headers;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function get($endpoint, $data = [])
    {
        return $this->request('GET', $endpoint, $data);
    }

    public function post($endpoint, $data = [], $files = [])
    {
        return $this->request('POST', $endpoint, $data, $files);
    }

    public function put($endpoint, $data)
    {
        return $this->request('PUT', $endpoint, $data);
    }

    public function delete($endpoint)
    {
        return $this->request('DELETE', $endpoint);
    }

    protected function request($method, $endpoint, $data = [], $files = [])
    {
        $request = Http::withToken($this->token)->withHeaders($this->headers)->withoutVerifying();

        if (!empty($files)) {
            foreach ($files as $key => $file) {
                $request->attach($key, file_get_contents($file->getRealPath()), $file->getClientOriginalName());
            }
        }


        $response = $request->$method($this->baseUrl . $endpoint, $data);

        return $response->json();
    }
}
