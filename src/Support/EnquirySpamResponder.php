<?php

namespace Hup234design\Cms\Support;

use Spatie\Honeypot\SpamResponder\SpamResponder;

use Closure;
use Illuminate\Http\Request;

class EnquirySpamResponder implements SpamResponder
{

    public function __invoke()
    {
        ray("EnquirySpamResponder");
    }

    public function respond(Request $request, Closure $next) {
        //
    }

//    {
//        $regularResponse = $next($request);
//
//
//        ray( $request );
//        ray( $next );
//
//        return $next($request);
//    }

}
