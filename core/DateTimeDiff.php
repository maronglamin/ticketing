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
            return '+ ' . $interval->d.'d ' . $interval->h.'hr '. $interval->i. 'min';
        }

        return '- ' . $interval->d.'d ' . $interval->h.'hr '. $interval->i. 'min';

    }

    public static function isDateCompared($firstTime, $endTime)
    {
        return (new DateTime($firstTime)) > (new DateTime($endTime));
    } 

}