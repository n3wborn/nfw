<?php

declare(strict_types=1);

namespace Nfw\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class LeapYearController
{
    private function is_leap_year(?string $year = null): bool
    {
        $year ??= intval(date('Y'));

        return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
    }

    public function index(Request $request): Response
    {
        if (self::is_leap_year($request->attributes->get('year'))) {
            return new Response('Yeap, this is a leap year');
        }

        return new Response('Nope, this is not a leap year');
    }
}
