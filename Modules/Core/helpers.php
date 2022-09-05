<?php

use Modules\Core\Libraries\formapro\values\HooksEnum;
use Modules\Core\Libraries\formapro\values\HookStorage;

if (!function_exists('setInterval')) {
    function setInterval($f, $milliseconds)
    {
        $seconds = (int)$milliseconds / 1000;
        while (true) {
            $f();
            sleep($seconds);
        }
    }
}
if (!function_exists('implodeValue')) {
    function implodeValue($types)
    {
        $strTypes = implode(",", $types);

        return $strTypes;
    }
}
if (!function_exists('getPercentOfNumber')) {
    function getPercentOfNumber($number, $percent)
    {
        return ($percent / 100) * $number;
    }
}
if (!function_exists('explodeValue')) {
    function explodeValue($types)
    {
        return explode(",", $types);
    }
}
if (!function_exists('random_code')) {
    function random_code()
    {
        return random_int(100000, 999999);
    }
}
if (!function_exists('urlExists')) {
    function urlExists($url)
    {
        if(empty($url)){
            return false;
        }
        if (@file_get_contents($url, false, null, 0, 1)) {
            return true;
        }

        return false;
    }
}

if (!function_exists('remove_special_char')) {
    function remove_special_char($text)
    {
        $t = $text;

        $specChars = [
            ' ' => '-',
            '!' => '',
            '"' => '',
            '#' => '',
            '$' => '',
            '%' => '',
            '&amp;' => '',
            '\'' => '',
            '(' => '',
            ')' => '',
            '*' => '',
            '+' => '',
            ',' => '',
            '₹' => '',
            '.' => '',
            '/-' => '',
            ':' => '',
            ';' => '',
            '<' => '',
            '=' => '',
            '>' => '',
            '?' => '',
            '@' => '',
            '[' => '',
            '\\' => '',
            ']' => '',
            '^' => '',
            '_' => '',
            '`' => '',
            '{' => '',
            '|' => '',
            '}' => '',
            '~' => '',
            '-----' => '-',
            '----' => '-',
            '---' => '-',
            '/' => '',
            '--' => '-',
            '/_' => '-',

        ];

        foreach ($specChars as $k => $v) {
            $t = str_replace($k, $v, $t);
        }

        return $t;
    }
}
if (!function_exists('arabic_w2e')) {
    function arabic_w2e($str)
    {
        $arabic_eastern = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $arabic_western = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($arabic_western, $arabic_eastern, $str);
    }
}
if (!function_exists('arabic_e2w')) {
    function arabic_e2w($str)
    {
        $arabic_eastern = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $arabic_western = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($arabic_eastern, $arabic_western, $str);
    }
}
if (!function_exists('convert2english')) {
    function convert2english($string)
    {
        try {
            $newNumbers = range(0, 9);
            // 1. Persian HTML decimal
            $persianDecimal = [
                '&#1776;',
                '&#1777;',
                '&#1778;',
                '&#1779;',
                '&#1780;',
                '&#1781;',
                '&#1782;',
                '&#1783;',
                '&#1784;',
                '&#1785;',
            ];
            // 2. Arabic HTML decimal
            $arabicDecimal = [
                '&#1632;',
                '&#1633;',
                '&#1634;',
                '&#1635;',
                '&#1636;',
                '&#1637;',
                '&#1638;',
                '&#1639;',
                '&#1640;',
                '&#1641;',
            ];
            // 3. Arabic Numeric
            $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
            // 4. Persian Numeric
            $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

            return str_replace([$persianDecimal, $arabicDecimal, $arabic, $persian], [
                $newNumbers,
                $newNumbers,
                $newNumbers,
                $newNumbers,
            ], $string);
        } catch (Throwable $ex) {
            return $string;
        }
    }
}
if (!function_exists('persian_number_to_english')) {
    function persian_number_to_english($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }
}
if (!function_exists('number_clean_format')) {
    function number_clean_format($num)
    {
        return preg_replace('/[^0-9.]/', '', $num);
    }
}
if (!function_exists('is_url_image')) {
    function is_url_image($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $headers = [];
        foreach (explode("\n", $output) as $line) {
            $parts = explode(':', $line);
            if (count($parts) == 2) {
                $headers[trim($parts[0])] = trim($parts[1]);
            }
        }

        return isset($headers["Content-Type"]) && strpos($headers['Content-Type'], 'image/') === 0;
    }
}
if (!function_exists('url_decode')) {
    function url_decode($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL) ? urldecode($url) : $url;
    }
}
if (!function_exists('price_t2r')) {
    function price_t2r($price)
    {
        $rial = $price * 10;

        return (int)$rial;
    }
}
if (!function_exists('price_r2t')) {
    function price_r2t($price)
    {
        $toman = $price / 10;

        return (int)$toman;
    }
}
if (!function_exists('hasPersianOrArabicLetter')) {
    function hasPersianOrArabicLetter(string $content): bool
    {
        return (bool)preg_match("/^[آ ا ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ی]/", $content);
    }
}
if (!function_exists('IsArabicNumber')) {
    function IsArabicNumber(string $number): bool
    {
        return (bool)preg_match("/(^[" . '\x{0660}-\x{0669}' . "]+$)/u", $number);
    }
}
if (!function_exists('IsPersianOrArabicNumber')) {
    function IsPersianOrArabicNumber(string $number): bool
    {
        return (bool)preg_match("/(^[" .
            '\x{0660}-\x{0669}' .
            '\x{06F0}-\x{06F9}' .
            "]+$)/u", $number);
    }
}
if (!function_exists('IsEmail')) {
    function IsEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
if (!function_exists('IsCellphone')) {
    function IsCellphone(string $number): bool
    {
        return (bool)preg_match('/^(^((98)|(\+98)|0)?(9){1}[0-9]{9})+$/', $number);
    }
}
if (!function_exists('IsIban')) {
    function IsIban(string $value): bool
    {
        if (empty($value)) {
            return false;
        }

        $ibanReplaceValues = [];
        $value = preg_replace('/[\W_]+/', '', strtoupper($value));
        if ((4 > strlen($value) || strlen($value) > 34) || (is_numeric($value [0]) || is_numeric($value [1])) ||
            (!is_numeric($value [2]) || !is_numeric($value [3]))) {
            return false;
        }

        $ibanReplaceChars = range('A', 'Z');
        foreach (range(10, 35) as $tempvalue) {
            $ibanReplaceValues[] = strval($tempvalue);
        }

        $tmpIBAN = substr($value, 4) . substr($value, 0, 4);
        $tmpIBAN = str_replace($ibanReplaceChars, $ibanReplaceValues, $tmpIBAN);
        $tmpValue = intval($tmpIBAN[0]);
        for ($i = 1, $iMax = strlen($tmpIBAN); $i < $iMax; $i++) {
            $tmpValue *= 10;
            $tmpValue += intval($tmpIBAN[$i]);
            $tmpValue %= 97;
        }

        return !($tmpValue != 1);
    }
}
if (!function_exists('IsNationalCode')) {
    function IsNationalCode(string $value): bool
    {
        if (
            preg_match('/^\d{8,10}$/', $value) == false ||
            preg_match('/^[0]{10}|[1]{10}|[2]{10}|[3]{10}|[4]{10}|[5]{10}|[6]{10}|[7]{10}|[8]{10}|[9]{10}$/', $value)
        ) {
            return false;
        }

        $sub = 0;
        switch (strlen($value)) {
            case 8:
                $value = '00' . $value;
                break;
            case 9:
                $value = '0' . $value;
                break;
        }

        for ($i = 0; $i <= 8; $i++) {
            $sub = $sub + ($value[$i] * (10 - $i));
        }

        $control = ($sub % 11) < 2 ? $sub % 11 : 11 - ($sub % 11);

        return $value[9] == $control ? true : false;
    }
}

if (!function_exists('IsCardNumber')) {
    function IsCardNumber(string $value): bool
    {
        $banks_names = [
            'bmi' => '603799',
            'bim' => '627961',
            'bki' => '603770',
            'bpi' => '502229',
            'bsi' => '603769',
            'edbi' => '627648',
            'sb24' => '621986',
            'sbank' => '639607',
            'ttbank' => '502908',
            'enbank' => '627412',
            'mebank' => '639370',
            'resalat' => '504172',
            'bank-day' => '502938',
            'postbank' => '627760',
            'sinabank' => '639346',
            'banksepah' => '589210',
            'ansarbank' => '627381',
            'refah-bank' => '589463',
            'bankmellat' => '610433',
            'shahr-bank' => '502806',
            'bank-maskan' => '628023',
            'tejaratbank' => '627353',
            'parsian-bank' => '622106',
            'karafarinbank' => '627488',
        ];

        if (!preg_match('/^\d{16}$/', $value) || !in_array(substr($value, 0, 6), $banks_names)) {
            return false;
        }

        $sum = 0;
        for ($position = 1; $position <= 16; $position++) {
            $temp = $value[$position - 1];
            $temp = $position % 2 === 0 ? $temp : $temp * 2;
            $temp = $temp > 9 ? $temp - 9 : $temp;
            $sum += $temp;
        }

        return $sum % 10 === 0;
    }
}
if (!function_exists('IsPostalCode')) {
    function IsPostalCode(string $value): bool
    {
        return (bool)preg_match("/^(\d{5}-?\d{5})$/", $value);
    }
}

if (!function_exists('IsPersianText')) {
    function IsPersianText(string $value): bool
    {
        return (bool)preg_match("/^[\x{600}-\x{6FF}\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\x{002E}\s]+$/u", $value);
    }
}
if (!function_exists('convert_size')) {
    function convert_size($size)
    {
        $unit = ['b', 'kb', 'mb', 'gb', 'tb', 'pb'];

        return @round($size / (1024 ** ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }
}
if (!function_exists('strip_tags_content')) {
    function strip_tags_content($string)
    {
        // ----- remove HTML TAGs -----
        $string = preg_replace('/<[^>]*>/', ' ', $string);
        // ----- remove control characters -----
        $string = str_replace(["\r", "\n", "\t"], ['', ' ', ' '], $string);
        // ----- remove multiple spaces -----
        $string = trim(preg_replace('/ {2,}/', ' ', $string));

        return $string;
    }
}
if (!function_exists('isBot')) {
    function isBot()
    {
        $bot_regex = '/BotLink|bingbot|AhrefsBot|ahoy|AlkalineBOT|anthill|appie|arale|araneo|AraybOt|ariadne|arks|ATN_Worldwide|Atomz|bbot|Bjaaland|Ukonline|borg\-bot\/0\.9|boxseabot|bspider|calif|christcrawler|CMC\/0\.01|combine|confuzzledbot|CoolBot|cosmos|Internet Cruiser Robot|cusco|cyberspyder|cydralspider|desertrealm, desert realm|digger|DIIbot|grabber|downloadexpress|DragonBot|dwcp|ecollector|ebiness|elfinbot|esculapio|esther|fastcrawler|FDSE|FELIX IDE|ESI|fido|H�m�h�kki|KIT\-Fireball|fouineur|Freecrawl|gammaSpider|gazz|gcreep|golem|googlebot|griffon|Gromit|gulliver|gulper|hambot|havIndex|hotwired|htdig|iajabot|INGRID\/0\.1|Informant|InfoSpiders|inspectorwww|irobot|Iron33|JBot|jcrawler|Teoma|Jeeves|jobo|image\.kapsi\.net|KDD\-Explorer|ko_yappo_robot|label\-grabber|larbin|legs|Linkidator|linkwalker|Lockon|logo_gif_crawler|marvin|mattie|mediafox|MerzScope|NEC\-MeshExplorer|MindCrawler|udmsearch|moget|Motor|msnbot|muncher|muninn|MuscatFerret|MwdSearch|sharp\-info\-agent|WebMechanic|NetScoop|newscan\-online|ObjectsSearch|Occam|Orbsearch\/1\.0|packrat|pageboy|ParaSite|patric|pegasus|perlcrawler|phpdig|piltdownman|Pimptrain|pjspider|PlumtreeWebAccessor|PortalBSpider|psbot|Getterrobo\-Plus|Raven|RHCS|RixBot|roadrunner|Robbie|robi|RoboCrawl|robofox|Scooter|Search\-AU|searchprocess|Senrigan|Shagseeker|sift|SimBot|Site Valet|skymob|SLCrawler\/2\.0|slurp|ESI|snooper|solbot|speedy|spider_monkey|SpiderBot\/1\.0|spiderline|nil|suke|http:\/\/www\.sygol\.com|tach_bw|TechBOT|templeton|titin|topiclink|UdmSearch|urlck|Valkyrie libwww\-perl|verticrawl|Victoria|void\-bot|Voyager|VWbot_K|crawlpaper|wapspider|WebBandit\/1\.0|webcatcher|T\-H\-U\-N\-D\-E\-R\-S\-T\-O\-N\-E|WebMoose|webquest|webreaper|webs|webspider|WebWalker|wget|winona|whowhere|wlm|WOLP|WWWC|none|XGET|Nederland\.zoek|AISearchBot|woriobot|NetSeer|Nutch|YandexBot|YandexMobileBot|SemrushBot|FatBot|MJ12bot|DotBot|AddThis|baiduspider|SeznamBot|mod_pagespeed|CCBot|openstat.ru\/Bot|m2e/i';
        $userAgent = empty($_SERVER['HTTP_USER_AGENT']) ? false : $_SERVER['HTTP_USER_AGENT'];

        return !$userAgent || preg_match($bot_regex, $userAgent);
    }
}
if (!function_exists('get_nested_property')) {
    function get_nested_property($property, $object)
    {
        if (isset($object->{$property})) {
            return $object->{$property};
        } elseif (isset($object[$property])) {
            return $object[$property];
        }
    }
}
if (!function_exists('make_slug')) {
    function make_slug($string, $separator = '-')
    {
        $string = trim($string);
        $string = mb_strtolower($string, 'UTF-8');
        $string = preg_replace("/[^a-z0-9_\-\sءاآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهی]/u", '', $string);
        $string = preg_replace("/[\s\-_]+/", ' ', $string);
        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }
}
if (!function_exists('isIpAddress')) {
    function isIpAddress($input)
    {
        $num = "(\\d|[1-9]\\d|1\\d\\d|2[0-4]\\d|25[0-5])";

        return preg_match("/^$num\\.$num\\.$num\\.$num$/", $input) === 1;
    }
}

if (!function_exists('isValidMD5')) {
    function isValidMD5($input)
    {
        return preg_match('/^[a-f0-9]{32}$/', $input);
    }
}

if (!function_exists('isValidMobile')) {
    function isValidMobile($input)
    {
        return (preg_match('/^(((98)|(\+98)|(0098)|0)(9){1}[0-9]{9})+$/', $input) || preg_match('/^(9){1}[0-9]{9}+$/', $input));
    }
}

if (!function_exists('isValidNationalCode')) {
    function isValidNationalCode($code)// مخصوص اشخاص حقیقی
    {
        if (!preg_match('/^[0-9]{10}$/', $code)) {
            return false;
        }

        for ($i = 0; $i < 10; $i++) {
            if (preg_match('/^' . $i . '{10}$/', $code)) {
                return false;
            }
        }

        for ($i = 0, $sum = 0; $i < 9; $i++) {
            $sum += ((10 - $i) * intval(substr($code, $i, 1)));
        }
        $sum %= 11;
        $parity = intval(substr($code, 9, 1));

        return (($sum < 2 && $sum == $parity) || ($sum >= 2 && $sum == 11 - $parity));
    }
}
if (!function_exists('isValidNationalId')) {
    function isValidNationalId($code)//مخصوص شرکت ها و اشخاص حقوقی
    {
        if (!preg_match('/^[0-9]{11}$/', $code)) {
            return false;
        }

        for ($i = 0; $i < 10; $i++) {
            if (preg_match('/^' . $i . '{11}$/', $code)) {
                return false;
            }
        }

        $adder = intval(substr($code, 9, 1)) + 2;
        $co = [29, 27, 23, 19, 17, 29, 27, 23, 19, 17];
        for ($i = 0, $sum = 0; $i < 10; $i++) {
            $sum += (intval(substr($code, $i, 1)) + $adder) * $co[$i];
        }
        $sum %= 11;
        $sum = ($sum == 10) ? 0 : $sum;
        $parity = intval(substr($code, 10, 1));

        return ($sum == $parity);
    }
}
if (!function_exists('generateVerificationCode')) {

    /**
     * @throws Exception
     */
    function generateVerificationCode($count_digits = 6)
    {
        return random_int(10 ** ($count_digits - 1), (10 ** $count_digits) - 1);
    }
}
if (!function_exists('generateRoundedVerificationCode')) {

    /**
     * @throws Exception
     */
    function generateRoundedVerificationCode(): string
    {
        $code = '';
        while (strlen($code) < 6) {
            $d1 = [1, 2, 3, 4, 5, 6, 7, 8, 9];
            $d1 = $d1[random_int(0, count($d1) - 1)];
            $d2 = [0, 5, $d1];
            $d2 = $d2[random_int(0, count($d2) - 1)];
            $code .= $d1 . $d2;
        }

        return $code;
    }
}
if (!function_exists('generateToken')) {
    function generateToken(): string
    {
        try {
            return md5(random_int(1, 10) . microtime());
        } catch (Exception $e) {
        }
    }
}
if (!function_exists('ta_persian_num')) {
    function ta_persian_num($string)
    {
        //arrays of persian and latin numbers
        $persian_num = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $latin_num = range(0, 9);

        $string = str_replace($latin_num, $persian_num, $string);

        return $string;
    }
}

if (!function_exists('ta_latin_num')) {
    function ta_latin_num($string)
    {
        //arrays of persian and latin numbers
        $persian_num = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $latin_num = range(0, 9);

        $string = str_replace($persian_num, $latin_num, $string);

        return $string;
    }
}
if (!function_exists('fixInput')) {
    function fixInput(&$request, $inputs)
    {
        $result = [];
        foreach ($inputs as $input) {
            if ($request->has($input)) {
                $result[$input] = ta_latin_num($request->get($input));
            }
        }

        $request->merge($result);
    }
}
if (!function_exists('farsiName')) {
    function farsiName($value)
    {
        return (bool)preg_match(
            "/^[\x{600}-\x{6FF}\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\s]+$/u",
            $value
        );
    }
}
if (!function_exists('add_trailing_slash')) {
    function add_trailing_slash($string)
    {
        $string = rtrim($string, '/\\');

        return $string . '/';
    }
}
if (!function_exists('passwordStrength')) {
    function passwordStrength($password)
    {
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        } else {
            echo 'Strong password.';
        }
    }
}
if (!function_exists('asset_cdn')) {
    function asset_cdn($asset, $secure = false)
    {
        $protocol = $secure ? 'https:' : 'http:';

        return $protocol . '//cdn.example.com/' . $asset;
    }
}
if (!function_exists('formatCode')) {
    function formatCode($code)
    {
        return str_replace(['<', '>'], ['HTMLOpenTag', 'HTMLCloseTag'], $code);
    }
}
if (!function_exists('set_values')) {

    //
    // require './Libraries/formapro/values/functions/array.php';
    // require './Libraries/formapro/values/functions/hook.php';
    // require './Libraries/formapro/values/functions/objects.php.php';
    // require './Libraries/formapro/values/functions/values.php.php';
    function set_values($object, array &$values, bool $byReference = false)
    {
        $func = (function (array &$values, $byReference) {
            if ($byReference) {
                $this->values = &$values;
            } else {
                $this->values = $values;
            }

            foreach (get_registered_hooks($this, HooksEnum::POST_SET_VALUES) as $callback) {
                call_user_func($callback, $this, $values, $byReference);
            }

            return $this;
        })->bindTo($object, $object);

        return $func($values, $byReference);
    }
}
if (!function_exists('get_values')) {
    function get_values($object, bool $copy = true): array
    {
        $values = (function () {
            return $this->values;
        })->call($object);

        return $copy ? array_copy($values) : $values;
    }
}
if (!function_exists('add_value')) {
    function add_value($object, $key, $value, $valueKey = null)
    {
        return (function ($key, $value, $valueKey) {
            foreach (get_registered_hooks($this, HooksEnum::PRE_ADD_VALUE) as $callback) {
                if (null !== $changedValue = call_user_func($callback, $this, $key, $value)) {
                    $value = $changedValue;
                }
            }

            $newValue = array_get($key, [], $this->values);
            if (false == is_array($newValue)) {
                throw new LogicException(sprintf('Cannot set value to %s it is already set and not array', $key));
            }

            if (null === $valueKey) {
                $newValue[] = $value;

                end($newValue);
                $valueKey = key($newValue);
                reset($newValue);

                $modified = array_set($key, $newValue, $this->values);
            } else {
                // workaround solution for a value key that contains dot.
                $newValue = array_get($key, [], $this->values);
                $newValue[$valueKey] = $value;

                $modified = array_set($key, $newValue, $this->values);
            }

            foreach (get_registered_hooks($this, HooksEnum::POST_ADD_VALUE) as $callback) {
                call_user_func($callback, $this, $key . '.' . $valueKey, $value, $modified);
            }

            return $valueKey;
        })->call($object, $key, $value, $valueKey);
    }
}
if (!function_exists('set_value')) {
    function set_value($object, $key, $value)
    {
        return (function ($key, $value) {
            foreach (get_registered_hooks($this, HooksEnum::PRE_SET_VALUE) as $callback) {
                if (null !== $newValue = call_user_func($callback, $this, $key, $value)) {
                    $value = $newValue;
                }
            }

            if (null !== $value) {
                $modified = array_set($key, $value, $this->values);
            } else {
                $modified = array_unset($key, $this->values);
            }

            foreach (get_registered_hooks($this, HooksEnum::POST_SET_VALUE) as $callback) {
                call_user_func($callback, $this, $key, $value, $modified);
            }
        })->call($object, $key, $value);
    }
}
if (!function_exists('get_value')) {
    function get_value($object, $key, $default = null, $castTo = null)
    {
        return (function ($key, $default, $castTo) {
            $value = array_get($key, $default, $this->values);

            foreach (get_registered_hooks($this, HooksEnum::POST_GET_VALUE) as $callback) {
                if (null !== $newValue = call_user_func($callback, $this, $key, $value, $default, $castTo)) {
                    $value = $newValue;
                }
            }

            return $value;
        })->call($object, $key, $default, $castTo);
    }
}
// TODO tobe reviewed
if (!function_exists('get_object_changed_values')) {
    function get_object_changed_values($object)
    {
        return (function () {
            $changedValues = $this->changedValues;

            // hack I know
            if (!property_exists($this, 'objects')) {
                return $changedValues;
            }
            foreach ($this->objects as $namespace => $namespaceValues) {
                foreach ($namespaceValues as $name => $values) {
                    if (is_array($values)) {
                        foreach ($values as $valueKey => $value) {
                            if ($changed = get_object_changed_values($value)) {
                                $changedValues[$namespace][$name][$valueKey] = $changed;
                            }
                        }
                    } elseif (is_object($values)) {
                        if ($changed = get_object_changed_values($values)) {
                            $changedValues[$namespace][$name] = $changed;
                        }
                    }
                }
            }


            return $changedValues;
        })->call($object);
    }
}
if (!function_exists('build_object_ref')) {
    function build_object_ref($classOrCallable = null, array $values = [], object $context = null, string $contextKey = null)
    {
        foreach (get_registered_hooks(HooksEnum::BUILD_OBJECT, HooksEnum::GET_OBJECT_CLASS) as $callback) {
            if ($dynamicClassOrCallable = $callback($values, $context, $contextKey, $classOrCallable)) {
                $classOrCallable = $dynamicClassOrCallable;
            }
        }

        if (false == $classOrCallable) {
            if ($context) {
                throw new LogicException(sprintf(
                    'Cannot built object for %s::%s. Either class or closure has to be passed explicitly or there must be a hook that provide an object class. Values: %s',
                    get_class($context),
                    $contextKey,
                    str_pad(var_export($values, true), 100)
                ));
            }
            throw new LogicException(sprintf(
                'Cannot built object. Either class or closure has to be passed explicitly or there must be a hook that provide an object class. Values: %s',
                str_pad(var_export($values, true), 100)
            ));
        }

        if (is_callable($classOrCallable)) {
            $class = $classOrCallable($values);
        } else {
            $class = (string)$classOrCallable;
        }

        $object = new $class();

        //values set in constructor
        $defaultValues = get_values($object, false);
        $values = array_replace($defaultValues, $values);

        set_values($object, $values, true);

        if ($context) {
            foreach (get_registered_hooks($context, HooksEnum::POST_BUILD_SUB_OBJECT) as $callback) {
                $callback($object, $context, $contextKey);
            }
        } else {
            foreach (get_registered_hooks($object, HooksEnum::POST_BUILD_OBJECT) as $callback) {
                $callback($object);
            }
        }

        return $object;
    }
}
if (!function_exists('build_object')) {
    function build_object($classOrCallable = null, array $values = [])
    {
        return build_object_ref($classOrCallable, $values);
    }
}
if (!function_exists('clone_object')) {
    function clone_object($object)
    {
        return build_object(get_class($object), get_values($object, true));
    }
}
if (!function_exists('register_cast_hooks')) {
    function register_cast_hooks($objectOrClass = null)
    {
        $castValueHook = function ($object, $key, $value) {
            return (function ($key, $value) {
                if (method_exists($this, 'castValue')) {
                    return $this->castValue($value);
                }
            })->call($object, $key, $value);
        };

        $castToHook = function ($object, $key, $value, $default, $castTo) {
            return (function ($key, $value, $default, $castTo) {
                if (method_exists($this, 'cast')) {
                    return $castTo ? $this->cast($value, $castTo) : $value;
                }
            })->call($object, $key, $value, $default, $castTo);
        };

        if ($objectOrClass) {
            register_hook($objectOrClass, HooksEnum::PRE_SET_VALUE, $castValueHook);
            register_hook($objectOrClass, HooksEnum::PRE_ADD_VALUE, $castValueHook);
            register_hook($objectOrClass, HooksEnum::POST_GET_VALUE, $castToHook);
        } else {
            register_global_hook(HooksEnum::PRE_SET_VALUE, $castValueHook);
            register_global_hook(HooksEnum::PRE_ADD_VALUE, $castValueHook);
            register_global_hook(HooksEnum::POST_GET_VALUE, $castToHook);
        }
    }
}
if (!function_exists('call')) {
    function call()
    {
        $args = func_get_args();

        /** @var object $object */
        $object = array_shift($args);

        /** @var Closure $closure */
        $closure = array_pop($args);

        return $closure->call($object, ...$args);
    }
}
if (!function_exists('register_object_hooks')) {
    function register_object_hooks()
    {
        $resetObjectsHook = function ($object, $key) {
            call($object, $key, function ($key) {
                if (property_exists($this, 'objects')) {
                    array_unset($key, $this->objects);
                }
            });
        };

        register_global_hook(HooksEnum::POST_SET_VALUE, $resetObjectsHook);
        register_global_hook(HooksEnum::POST_ADD_VALUE, $resetObjectsHook);
        register_global_hook(HooksEnum::POST_SET_VALUES, function ($object) {
            call($object, function () {
                $this->objects = [];
            });
        });
    }
}
if (!function_exists('set_object')) {

    /**
     * @param object $context
     * @param string $key
     * @param object|null $object
     */
    function set_object($context, $key, $object)
    {
        (function ($key, $object) use ($context) {
            if ($object) {
                set_value($this, $key, null);
                set_value($this, $key, get_values($object, false));

                $values =& array_get($key, [], $this->values);
                set_values($object, $values, true);

                array_set($key, $object, $this->objects);

                foreach (get_registered_hooks($context, HooksEnum::POST_SET_OBJECT) as $callback) {
                    call_user_func($callback, $object, $context, $key);
                }
            } else {
                set_value($this, $key, null);
                array_unset($key, $this->objects);
            }
        })->call($context, $key, $object);
    }
}
if (!function_exists('set_objects')) {

    /**
     * @param object $context
     * @param string $key
     * @param object[]|null $objects
     */
    function set_objects($context, $key, $objects)
    {
        (function ($key, $objects) use ($context) {
            if (null !== $objects) {
                array_set($key, [], $this->objects);

                $objectsValues = [];
                foreach ($objects as $objectKey => $object) {
                    array_set($objectKey, get_values($object, false), $objectsValues);
                }

                set_value($this, $key, $objectsValues);

                foreach ($objects as $objectKey => $object) {
                    $values =& array_get($key . '.' . $objectKey, [], $this->values);
                    set_values($object, $values, true);

                    array_set($key . '.' . $objectKey, $object, $this->objects);

                    foreach (get_registered_hooks($context, HooksEnum::POST_SET_OBJECT) as $callback) {
                        call_user_func($callback, $object, $context, $key . '.' . $objectKey);
                    }
                }
            } else {
                set_value($this, $key, null);
                array_unset($key, $this->objects);
            }
        })->call($context, $key, $objects);
    }
}
if (!function_exists('add_object')) {

    /**
     * @param string $key
     * @param object $object
     * @param string|null $objectKey
     */
    function add_object($context, $key, $object, $objectKey = null)
    {
        (function ($key, $object, $objectKey) use ($context) {
            $objectValues = get_values($object, false);

            $objectKey = add_value($this, $key, $objectValues, $objectKey);

            $values =& array_get($key . '.' . $objectKey, [], $this->values);
            set_values($object, $values, true);

            array_set($key . '.' . $objectKey, $object, $this->objects);

            foreach (get_registered_hooks($context, HooksEnum::POST_ADD_OBJECT) as $callback) {
                call_user_func($callback, $object, $context, $key . '.' . $objectKey);
            }
        })->call($context, $key, $object, $objectKey);
    }
}
if (!function_exists('get_object')) {

    /**
     * @param object $object
     * @param string $key
     * @param string|Closure|null $classOrClosure
     * @return null|object
     */
    function get_object($object, $key, $classOrClosure = null)
    {
        return (function ($key, $classOrClosure) {
            if (false != $object = array_get($key, null, $this->objects)) {
                return $object;
            }
            $values =& array_get($key, null, $this->values);
            if (null === $values) {
                return;
            }

            $object = build_object_ref($classOrClosure, $values, $this, $key);

            array_set($key, $object, $this->objects);


            return $object;
        })->call($object, $key, $classOrClosure);
    }
}
if (!function_exists('get_objects')) {

    /**
     * @param string $key
     * @param string|Closure|null $classOrClosure
     * @return Traversable
     */
    function get_objects($context, $key, $classOrClosure = null)
    {
        return (function ($key, $classOrClosure) {
            foreach (array_keys(array_get($key, [], $this->values)) as $valueKey) {
                if (false != $object = array_get("$key.$valueKey", null, $this->objects)) {
                    yield $valueKey => $object;
                    continue;
                }
                if ($object = get_object($this, "$key.$valueKey", $classOrClosure)) {
                    array_set("$key.$valueKey", $object, $this->objects);
                } else {
                    throw new LogicException(sprintf('The object on path "%s" could not be built. The path value is null.', "$key.$valueKey"));
                }


                yield $valueKey => $object;
            }
        })->call($context, $key, $classOrClosure);
    }
}
if (!function_exists('register_propagate_root_hooks')) {
    function register_propagate_root_hooks($object)
    {
        register_hook($object, HooksEnum::POST_SET_OBJECT, function ($object, $context, $contextKey) {
            propagate_root($object, $context, $contextKey);
        });

        register_hook($object, HooksEnum::POST_ADD_OBJECT, function ($object, $context, $contextKey) {
            propagate_root($object, $context, $contextKey);
        });

        register_hook($object, HooksEnum::POST_BUILD_SUB_OBJECT, function ($object, $context, $contextKey) {
            register_propagate_root_hooks($object);
            propagate_root($object, $context, $contextKey);
        });
    }
}
if (!function_exists('propagate_root')) {
    function propagate_root($object, $parentObject, $parentKey)
    {
        if (false == $parentObject) {
            return;
        }

        [$rootObject, $rootObjectKey] = call($parentObject, $parentKey, function ($parentKey) {
            return [
                isset($this->rootObject) ?: $this,
                isset($this->rootObjectKey) ? $this->rootObjectKey . '.' . $parentKey : $parentKey,
            ];
        });

        call($object, $rootObject, $rootObjectKey, function ($rootObject, $rootObjectKey) {
            $this->rootObject = $rootObject;
            $this->rootObjectKey = $rootObjectKey;
        });
    }
}
if (!function_exists('register_hook')) {
    function register_hook($objectOrClass, $hook, Closure $callback)
    {
        HookStorage::register($objectOrClass, $hook, $callback);
    }
}
if (!function_exists('register_global_hook')) {

    /**
     * @param string $hook
     * @param Closure $callback
     */
    function register_global_hook($hook, Closure $callback)
    {
        HookStorage::registerGlobal($hook, $callback);
    }
}
if (!function_exists('get_registered_hooks')) {

    /**
     * @param object|string $objectOrClass
     * @param string $hook
     * @return Closure[]|Traversable
     */
    function get_registered_hooks($objectOrClass, $hook)
    {
        return HookStorage::get($objectOrClass, $hook);
    }
}
if (!function_exists('array_get')) {
    function &array_get($key, $default, &$values)
    {
        if (false == preg_match('/([\d\w]*)\.?/', $key)) {
            throw new LogicException(sprintf('The key must contain only a-Z0-9 and "." symbols. Got "%s"', $key));
        }

        $path = str_replace('.', '\'][\'', $key);

        $result = null;
        eval('
        if (isset($values[\'' . $path . '\'])) {
            $result =& $values[\'' . $path . '\'];
        } else {
            $result = $default;
        }
    ');

        return $result;
    }
}
if (!function_exists('array_set')) {

    /**
     * @param string $key
     * @param mixed $value
     * @param array $values
     * @return bool return true if a modification to data was done, false if nothing is changed
     */
    function array_set($key, $value, array &$values)
    {
        $keys = explode('.', $key);

        array_path_set($values, $keys, $value);

        return true;
    }
}
if (!function_exists('array_has')) {
    function array_has($key, array &$values)
    {
        if (false == preg_match('/([\d\w]*)\.?/', $key)) {
            throw new LogicException(sprintf('The key must contain only a-Z0-9 and "." symbols. Got "%s', $key));
        }

        $path = str_replace('.', '\'][\'', $key);

        $result = false;
        eval('$result = isset($values[\'' . $path . '\']);');

        return $result;
    }
}
if (!function_exists('array_unset')) {

    /**
     * @param $key
     * @param array $values
     * @return bool Returns true if data was changed, false if it is unchanged.
     */
    function array_unset($key, array &$values)
    {
        if (false == preg_match('/([\d\w]*)\.?/', $key)) {
            throw new LogicException(sprintf('The key must contain only a-Z0-9 and "." symbols. Got "%s', $key));
        }

        $path = str_replace('.', '\'][\'', $key);

        $result = false;
        eval('$result = isset($values[\'' . $path . '\']);');
        eval('unset($values[\'' . $path . '\']);');

        return $result;
    }
}
if (!function_exists('array_copy')) {
    function array_copy(array $array)
    {
        // values array may contain sub array passed as a reference to a sub object.
        // this code removes such refs from the array.
        // Here's "foreach rec optimized" version which showed the best result
        // performance results (1000 cycles):
        //   get_values              - 0.001758
        //   foreach rec optimized   - 0.008587
        //   foreach recursion       - 0.015547
        //   serialize\unserialze    - 0.020816
        //   json encode\decode      - 0.078953
        $copiedArray = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = array_copy($value);
            }

            $copiedArray[$key] = $value;
        }

        return $copiedArray;
    }
}
if (!function_exists('array_path_set')) {

    /**
     * @see https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Component%21Utility%21NestedArray.php/function/NestedArray%3A%3AsetValue/8
     */
    function array_path_set(array &$array, array $keys, $value, $force = false)
    {
        $ref = &$array;
        foreach ($keys as $parent) {
            // PHP auto-creates container arrays and NULL entries without error if $ref
            // is NULL, but throws an error if $ref is set, but not an array.
            if ($force && isset($ref) && !is_array($ref)) {
                $ref = [];
            }
            $ref = &$ref[$parent];
            if (!is_array($ref)) {
                $ref = [];
            }
        }
        $ref = $value;
    }
}
if (!function_exists('getIconOfUrl')) {
    function getIconOfUrl($url, $size = 48)
    {
        $domain = getDomain($url);

        return 'https://api.faviconkit.com/' . $domain . '/' . $size;
        // https://www.google.com/s2/favicons?domain=.$domain
    }
}
if (!function_exists('getDomain')) {
    function getDomain($url)
    {
        // URL to lower case
        $url = strtolower($url);

        // Get the Domain from the URL
        $domain = parse_url($url, PHP_URL_HOST);

        // Check Domain
        $domainParts = explode('.', $domain);
        if (count($domainParts) == 3 and $domainParts[0] != 'www') {
            // With Subdomain (if not www)
            $domain = $domainParts[0] . '.' .
                $domainParts[count($domainParts) - 2] . '.' . $domainParts[count($domainParts) - 1];
        } elseif (count($domainParts) >= 2) {
            // Without Subdomain
            $domain = $domainParts[count($domainParts) - 2] . '.' . $domainParts[count($domainParts) - 1];
        } else {
            // Without http(s)
            $domain = $url;
        }

        return $domain;
    }
}

if (!function_exists('json_validate')) {
    function json_validate($string)
    {
        // decode the JSON data
        $result = json_decode($string);

        // switch and check possible JSON errors
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                $error = ''; // JSON is valid // No error has occurred
                break;
            case JSON_ERROR_DEPTH:
                $error = 'The maximum stack depth has been exceeded.';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $error = 'Invalid or malformed JSON.';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $error = 'Control character error, possibly incorrectly encoded.';
                break;
            case JSON_ERROR_SYNTAX:
                $error = 'Syntax error, malformed JSON.';
                break;
            // PHP >= 5.3.3
            case JSON_ERROR_UTF8:
                $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
                break;
            // PHP >= 5.5.0
            case JSON_ERROR_RECURSION:
                $error = 'One or more recursive references in the value to be encoded.';
                break;
            // PHP >= 5.5.0
            case JSON_ERROR_INF_OR_NAN:
                $error = 'One or more NAN or INF values in the value to be encoded.';
                break;
            case JSON_ERROR_UNSUPPORTED_TYPE:
                $error = 'A value of a type that cannot be encoded was given.';
                break;
            default:
                $error = 'Unknown JSON error occured.';
                break;
        }

        if ($error !== '') {
            return $string;
            // throw the Exception or exit // or whatever :)
            exit($error);
        }

        // everything is OK
        return $result;
    }
}

if (!function_exists('encrypt_decrypt_base64')) {
    function encrypt_decrypt_base64($string, $action = 'encrypt')
    {
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; // user define private key
        $secret_iv = '5fgf5HJ5g27'; // user define secret key
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } elseif ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }
}

if (!function_exists('isSiteAvailible')) {
    function isSiteAvailible($url)
    {
        // Check, if a valid url is provided
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        // Initialize cURL
        $curlInit = curl_init($url);

        // Set options
        curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curlInit, CURLOPT_HEADER, true);
        curl_setopt($curlInit, CURLOPT_NOBODY, true);
        curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

        // Get response
        $response = curl_exec($curlInit);

        // Close a cURL session
        curl_close($curlInit);

        return $response ? true : false;
    }
}

if (!function_exists('pingWebsite')) {
    function pingWebsite($host, $port, $timeout)
    {
        $tB = microtime(true);
        $fP = fSockOpen($host, $port, $errno, $errstr, $timeout);
        if (!$fP) {
            return "down";
        }
        $tA = microtime(true);

        return round((($tA - $tB) * 1000), 0) . " ms";
    }
}

if (!function_exists('numberFormatPrecision')) {
    function numberFormatPrecision($number, $precision = 2, $separator = '.')
    {
        $numberParts = explode($separator, $number);
        $response = $numberParts[0];
        if (count($numberParts) > 1 && $precision > 0) {
            $response .= $separator;
            $response .= substr($numberParts[1], 0, $precision);
        }

        return $response;
    }
}

if (!function_exists('exceptionHandleRouter')) {
    function exceptionHandleRouter($exception, $router)
    {
        ++$router->attempt_fail;
        $router->last_status = $exception->getMessage();

        $router->save();

        if ($router->attempt_fail > 10) {
            $router->update([
                'active' => false,
            ]);
        }

        $bot = new Bot('1190195935:AAG_ykn8pcR05Ks0LkNE69XlybK9UGOJ8ro');
        $bot->sendMessage(new SendMessage('105627554', $exception->getMessage() . ' ' . $exception->getFile() .
            ' ' . $exception->getLine()));

        return false;

        throw $exception;
    }
}

if (!function_exists('generateVerified')) {

    /**
     * ایجاد یک کد شناسایی کاربر
     *
     * @return string
     */
    function generateVerified()
    {
        $random = bin2hex(openssl_random_pseudo_bytes(32));
        $verifier = base64UrlSafeEncode(pack('H*', $random));

        return $verifier;
    }
}

if (!function_exists('generateCodeChallenge')) {

    /**
     * ساخت یک challenge code
     *
     * @param $codeVerifier
     * @return string
     */
    function generateCodeChallenge($codeVerifier)
    {
        return base64UrlSafeEncode(pack('H*', hash('sha256', $codeVerifier)));
    }
}

if (!function_exists('base64UrlSafeEncode')) {

    /**
     * escape رشته
     *
     * @param $string
     * @return string
     */
    function base64UrlSafeEncode($string)
    {
        return rtrim(strtr(base64_encode($string), '+/', '-_'), '=');
    }
}

if (!function_exists('is_empty')) {
    function is_empty($var): bool
    {
        return empty($var);
    }
}

if (!function_exists('new_visit')) {
    function new_visit($model, $data = [])
    {
        try {
            if (!$model->clicks) {
                return false;
            }

            $userAgent = request()->header('User-Agent');
            $agent = new Agent();

            $agent->setUserAgent($userAgent);
            $agent->setHttpHeaders(request()->headers);
            // $geoip = geoip()->getLocation(request()->ip()) ?? null;

            $is_duplicate = $model->clicks()->where('ip', request()->ip())->exists();

            $click = $model->clicks()->create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'ip' => request()->ip() ?? null,
                'method' => request()->getMethod() ?? null,
                'url' => ($data['url'] ?? url()) ?? null,
                'os' => $agent->platform() ?? null,
                'referer' => request()->headers->get('referer') ?? null,
                'bot' => $agent->robot() ?? null,
                'user_agent' => $userAgent ?? null,
                // 'country'      => $geoip['country_name'] ?? null,
                // 'country_code' => $geoip['country_code2'] ?? null,
                // 'city'         => $geoip['city'] ?? null,
                // 'lat'          => $geoip['latitude'] ?? null,
                // 'long'         => $geoip['longitude'] ?? null,
                'browser' => $agent->browser() ?? null,
                'is_desktop' => $agent->isDesktop() ?? null,
                'is_mobile' => $agent->isMobile() ?? null,
                'is_bot' => $agent->isRobot() ?? null,
                'status' => $is_duplicate ? 'duplicate' : 'new',
            ]);

            // dd($click);

            return $click;
        } catch (Throwable $ex) {
            // throw $ex;
            return false;
        }
    }
}

if (! function_exists('bank_name')) {
    function bank_name($string)
    {
        if (empty($string)) {
            return '';
        }
        $banks_names = [
            'بلو بانک' => '62198619',
            'بانکینو' => '585947',
            'بانک ملی ایران' => '603799',
            'بانک سپه' => '589210',
            'بانک توسعه صادرات' => '627648',
            'بانک صنعت و معدن' => '627961',
            'بانک کشاورزی' => '603770',
            'بانک مسکن' => '628023',
            'پست بانک ایران' => '627760',
            'بانک توسعه تعاون' => '502908',
            'بانک اقتصاد نوین' => '627412',
            'بانک پارسیان' => '622106',
            'بانک پاسارگاد' => '502229',
            'بانک کارآفرین' => '504172',
            'بانک سامان' => '621986',
            'بانک سینا' => '639346',
            'بانک سرمایه' => '639607',
            'بانک تات' => '636214',
            'بانک شهر' => '502806',
            'بانک دی' => '502938',
            'بانک صادرات' => '603769',
            'بانک ملت' => '610433',
            'بانک تجارت' => '627353',
            'بانک رفاه' => '589463',
            'بانک انصار' => '627381',
            'بانک مهر اقتصاد' => '639370',
        ];

        foreach ($banks_names as $key => $value) {
            if (\Illuminate\Support\Str::startsWith($string, $value)) {
                return $key;
            }
        }
    }
}
