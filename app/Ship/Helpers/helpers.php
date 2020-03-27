<?php

// persian helpers

if (!function_exists('persian')) {
    function persian($string, $digits = true)
    {
        $farsiArray   = array("۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹");
        $arabicArray  = array("٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩");
        $englishArray = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

        $nonPersianArray = array("ى", "ي", "ك", "ئ", "إ", "أ", "ٱ", "ة", "ؤ", "ء");
        $persianArray    = array("ی", "ی", "ک", "ی", "ا", "ا", "ﺍ", "ه", "و", "");

        if ($digits) {
            $string = str_replace($englishArray, $farsiArray, $string);
            $string = str_replace($arabicArray, $farsiArray, $string);
        }
        $string = str_replace($nonPersianArray, $persianArray, $string);

        return $string;
    }
}

if (!function_exists('english')) {
    function english($string)
    {
        $farsiArray   = array("۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹");
        $arabicArray  = array("٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩");
        $englishArray = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

        $string = str_replace($farsiArray, $englishArray, $string);
        $string = str_replace($arabicArray, $englishArray, $string);

        return $string;
    }
}


if (!function_exists('englishFilter')) {
    function englishFilter(array $object)
    {
        foreach ($object as $key => $val) {
            $object [$key] = english($val);
        }

        return $object;
    }
}

if (!function_exists('money')) {
    function money($string, $currency = false, $locale = 'fa')
    {
        $money = ($locale == 'fa') ? persian(number_format($string)) : number_format($string);

        return $money . ($currency ? ' ریال' : '');
    }
}

function is_mobile(string $sting): bool
{
    if (!preg_match(config('regex.mobile_regex'), $sting)) {
        return false;
    }

    return true;
}

function mobilify(string $mobile, string $prefix = ''): string
{
    return $prefix . substr($mobile, -10);
}

if (!function_exists('fix_persian_num')) {
    /**
     * convert the given number to persian
     *
     * @param $text
     *
     * @return null|string
     */
    function fix_persian_num($text)
    {

        if (is_null($text)) {
            return null;
        }
        $replacePairs = array(
            "0" => chr(0xDB) . chr(0xB0),
            "1" => chr(0xDB) . chr(0xB1),
            "2" => chr(0xDB) . chr(0xB2),
            "3" => chr(0xDB) . chr(0xB3),
            "4" => chr(0xDB) . chr(0xB4),
            "5" => chr(0xDB) . chr(0xB5),
            "6" => chr(0xDB) . chr(0xB6),
            "7" => chr(0xDB) . chr(0xB7),
            "8" => chr(0xDB) . chr(0xB8),
            "9" => chr(0xDB) . chr(0xB9),
        );

        return strtr($text, $replacePairs);

    }
}

function isRtl()
{
    return in_array(app()->getLocale(), ['fa', 'ar']);
}
