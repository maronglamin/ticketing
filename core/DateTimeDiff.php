<?php

namespace core;

use DateTime;
use DateTimeImmutable;

class DateTimeDiff
{
    public static function TimeDifference($first, $second)
    {        
        $interval = (new DateTimeImmutable($first))->diff(new DateTimeImmutable($second));
        if ($second > $first) {
            return '+ ' . $interval->h.'hr '. $interval->i. 'min'; 
        }

        return '- ' . $interval->h.'hr '. $interval->i. 'min'; 

    }

}