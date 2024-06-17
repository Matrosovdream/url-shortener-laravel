<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use App\Models\Url;

class UrlService extends ServiceProvider
{

    public static function findOrCreate( $original_url ) {

        $url = Url::where('original_url', $original_url)->first();
        if (!$url) {
            
            // Generate unique short hash
            $shortHash = Str::random(6);
            while (Url::where('short_hash', $shortHash)->exists()) {
                $shortHash = Str::random(6);
            }

            // Create new URL
            $url = Url::create([
                'original_url' => $original_url,
                'short_hash' => $shortHash
            ]);
        }

        return $url;

    }

    public static function findHashUrl( $hash ) {
        $url = Url::where('short_hash', $hash)->firstOrFail();
        return $url->original_url;
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
