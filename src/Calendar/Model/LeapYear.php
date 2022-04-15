<?php

declare(strict_types=1);

namespace Nfw\Calendar\Model;

final class LeapYear
{
    public function is_leap_year(?string $year = null): bool
    {
        $year ??= intval(date('Y'));

        return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
    }
}
