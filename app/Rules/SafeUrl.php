<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Providers\SafeBrowsingService;

class SafeUrl implements ValidationRule
{

    private $service;

    public function __construct() {
        $this->service = new SafeBrowsingService();
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if( !$this->service->checkUrl($value) ) {
            $fail( $this->message() );
        } 

    }

    public function message()
    {
        return "The URL isn't valid";
    }

}
