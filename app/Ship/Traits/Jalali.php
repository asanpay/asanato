<?php

namespace App\Ship\Traits;

use Tartan\Zaman\Facades\Zaman;

trait Jalali
{
    /**
     * @return int
     */
    public static function jalaliTimestamp(): int
    {
        return Zaman::gToj('now', 'yyyyMMddHHmmss', 'en');
    }

    /**
     * @param $date
     * @param string $format
     * @param string $lang
     *
     * @return string
     */
    public static function jalaliDate($date, $format = 'EEEE، dd MMMM yyyy ساعت H:m', $lang = 'fa'): string
    {
        return Zaman::gToj($date, $format, $lang);
    }

    /**
     * 13 98 04 08 15 37 22
     *
     * @param int $jalaliStamp
     * @param string $format
     *
     * @return string
     */
    public static function formatJalali(int $jalaliStamp, string $format = 'datetime'): string
    {
        $parts = str_split("{$jalaliStamp}", 2);

        $date = $parts[0] . $parts[1] . '/' . $parts[2] . '/' . $parts[3];
        $time = $parts[4] . ':' . $parts[5] . ':' . $parts[6];

        switch ($format) {
            case 'date' : {
                return $date;
            }
            case 'time' : {
                return $time;
            }
            default:{
                return $date . ' ' . $time;
            }
        }
    }
}
