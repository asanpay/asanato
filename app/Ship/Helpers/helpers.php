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

if (!function_exists('currency')) {
    function currency($amount): int
    {
        return intval($amount);
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
    return $prefix . substr(trim($mobile), -10);
}

function emailify(string $email): string
{
    return strtolower(trim($email));
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

if (!function_exists('random_string')) {

    function random_string($length, $type = ''): string
    {
        // Select which type of characters you want in your random string
        switch ($type) {
            case 'free':
            {
                return substr(base64_encode(openssl_random_pseudo_bytes($length)), 0, $length);
            }
            case 'num':
                // Use only numbers
                $salt = '1234567890';
                break;
            case 'lower':
                // Use only lowercase letters
                $salt = 'abcdefghijklmnopqrstuvwxyz';
                break;
            case 'upper':
                // Use only uppercase letters
                $salt = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            default:
                // Use uppercase, lowercase, numbers, and symbols
                $salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                break;
        }
        $rand = '';
        $i    = 0;
        while ($i < $length) { // Loop until you have met the length
            $num  = rand() % strlen($salt);
            $tmp  = substr($salt, $num, 1);
            $rand = $rand . $tmp;
            $i++;
        }

        return $rand; // Return the random string
    }
}

function isRtl()
{
    return in_array(app()->getLocale(), ['fa', 'ar']);
}

function transaction_flag()
{
    return config('app.abrv', 'AP') . random_string(2, 'upper');
}

function xd()
{
    $p = array_merge(func_get_args(), ['random' => mt_rand(1,100)]);
    var_dump($p);
    exit;
}
