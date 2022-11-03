<?php

namespace App\Actions\Exam;

use Illuminate\Support\Facades\Http;

class ConsumeAPI
{
    private $url;
    private $secret;
    private $endpointToken;
    private $endpointConsult;

    public function __construct()
    {
        $this->url = config('services.exam.endpoint');
        $this->secret = config('services.exam.secret');
        $this->endpointToken = 'oauth/token';
        $this->endpointConsult = 'api/me';
    }
    public function execute()
    {
        $token = HTTP::post($this->url . '/' . $this->endpointToken, [
            "grant_type" => "password",
            "client_id" => "3",
            "client_secret" => $this->secret,
            "username" => "joe@doe.com",
            "password" => "secret",
            "scope" => "*"
        ])->json();

        $consult = HTTP::withToken($token['access_token'])
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])
            ->get($this->url . '/' . $this->endpointConsult)->json();

        return $consult;
    }
}
