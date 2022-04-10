<?php

declare(strict_types=1);

namespace Nfw\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeapYearController
{
    public function index(Request $request)
    {
        if (is_leap_year($request->attributes->get('year'))) {
            return new Response('Yeap, this is a leap year');
        }

        return new Response('Nope, this is not a leap year');
    }
}
