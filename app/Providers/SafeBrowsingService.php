<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class SafeBrowsingService extends ServiceProvider
{
    private $api_base_url;
    private $api_key;
    private $client_id;
    private $client_version;

    public function __construct() {

        $this->api_base_url = config("services.safebrowsing.base_url");
        $this->api_key = config("services.safebrowsing.key");
        $this->client_id = config("services.safebrowsing.client_id");
        $this->client_version = config("services.safebrowsing.client_version");

    }

    public function checkUrl($url)
    {
        // Check if URL is safe
        $url = $this->api_base_url."threatMatches:find?key={$this->api_key}";
        $response = Http::post($url, [
            'client' => [
                'clientId' => $this->client_id,
                'clientVersion' => $this->client_version
            ],
            'threatInfo' => [
                'threatTypes' => ["MALWARE", "SOCIAL_ENGINEERING"],
                'platformTypes' => ["ANY_PLATFORM"],
                'threatEntryTypes' => ["URL"],
                'threatEntries' => [
                    ['url' => $url]
                ]
            ]
        ]);

        if ($response->json() && isset($response->json()['matches'])) {
            return false;
        } else {
            return true;
        }

    }    

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
