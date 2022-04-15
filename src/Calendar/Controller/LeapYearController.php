<?php

declare(strict_types=1);

namespace Nfw\Calendar\Controller;

use Nfw\Calendar\Model\LeapYear;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class LeapYearController
{
    public function index(?string $year, Request $request): Response
    {
        $leapYear = new LeapYear();

        if ($leapYear->is_leap_year($year)) {
            return new Response('Yeap, this is a leap year');
        }

        return new Response('Nope, this is not a leap year');
    }
}
