<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class ApiClient
{
    protected $baseUrl;
    protected $token;

    public function __construct($baseUrl, $token = null)
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function get($endpoint, $data = [])
    {
        return $this->request('GET', $endpoint, $data);
    }

    public function post($endpoint, $data, $files = [])
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
        $request = Http::withToken($this->token);

        if (!empty($files)) {
            foreach ($files as $key => $file) {
                $request->attach($key, file_get_contents($file->getRealPath()), $file->getClientOriginalName());
            }
        }

        try {
            $response = $request->$method($this->baseUrl . $endpoint, $data);

            return $response->json();
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
