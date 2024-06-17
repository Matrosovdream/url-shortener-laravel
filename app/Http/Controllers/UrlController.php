<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Providers\UrlService;
use App\Rules\SafeUrl;

class UrlController extends Controller
{

    public function shorten(Request $request)
    {

        // Validate URL
        $request->validate([
            'url' => [ 'required', 'url', new SafeUrl() ]
        ]);

        // Check if URL already exists or create new
        $url = UrlService::findOrCreate( $request->url );
        return response()->json(['short_url' => url($url->short_hash)]);

    }

    public function redirect($hash)
    {
        return redirect( UrlService::findHashUrl($hash) );
    }

    public function redirectFolder($any, $hash)
    {
        return redirect( UrlService::findHashUrl($hash) );
    }    

}
