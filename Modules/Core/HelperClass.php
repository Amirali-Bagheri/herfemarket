<?php

namespace Modules\Core;

class HelperClass
{
    public static function custom_slug(string $string, string $separator = '-'): string
    {
        $_transliteration = [
            '/ä|æ|ǽ/'                         => 'ae',
            '/ö|œ/'                           => 'oe',
            '/ü/'                             => 'ue',
            '/Ä/'                             => 'Ae',
            '/Ü/'                             => 'Ue',
            '/Ö/'                             => 'Oe',
            '/À|Á|Â|Ã|Å|Ǻ|Ā|Ă|Ą|Ǎ/'           => 'A',
            '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª/'         => 'a',
            '/Ç|Ć|Ĉ|Ċ|Č/'                     => 'C',
            '/ç|ć|ĉ|ċ|č/'                     => 'c',
            '/Ð|Ď|Đ/'                         => 'D',
            '/ð|ď|đ/'                         => 'd',
            '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě/'             => 'E',
            '/è|é|ê|ë|ē|ĕ|ė|ę|ě/'             => 'e',
            '/Ĝ|Ğ|Ġ|Ģ/'                       => 'G',
            '/ĝ|ğ|ġ|ģ/'                       => 'g',
            '/Ĥ|Ħ/'                           => 'H',
            '/ĥ|ħ/'                           => 'h',
            '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ/'           => 'I',
            '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı/'           => 'i',
            '/Ĵ/'                             => 'J',
            '/ĵ/'                             => 'j',
            '/Ķ/'                             => 'K',
            '/ķ/'                             => 'k',
            '/Ĺ|Ļ|Ľ|Ŀ|Ł/'                     => 'L',
            '/ĺ|ļ|ľ|ŀ|ł/'                     => 'l',
            '/Ñ|Ń|Ņ|Ň/'                       => 'N',
            '/ñ|ń|ņ|ň|ŉ/'                     => 'n',
            '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ/'         => 'O',
            '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º/'       => 'o',
            '/Ŕ|Ŗ|Ř/'                         => 'R',
            '/ŕ|ŗ|ř/'                         => 'r',
            '/Ś|Ŝ|Ş|Ș|Š/'                     => 'S',
            '/ś|ŝ|ş|ș|š|ſ/'                   => 's',
            '/Ţ|Ț|Ť|Ŧ/'                       => 'T',
            '/ţ|ț|ť|ŧ/'                       => 't',
            '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ/' => 'U',
            '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ/' => 'u',
            '/Ý|Ÿ|Ŷ/'                         => 'Y',
            '/ý|ÿ|ŷ/'                         => 'y',
            '/Ŵ/'                             => 'W',
            '/ŵ/'                             => 'w',
            '/Ź|Ż|Ž/'                         => 'Z',
            '/ź|ż|ž/'                         => 'z',
            '/Æ|Ǽ/'                           => 'AE',
            '/ß/'                             => 'ss',
            '/Ĳ/'                             => 'IJ',
            '/ĳ/'                             => 'ij',
            '/Œ/'                             => 'OE',
            '/ƒ/'                             => 'f',
        ];

        $quotedReplacement = preg_quote($separator, '/');

        $merge = [
            '/[^\s\p{Zs}\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu'              => ' ',
            '/[\s\p{Zs}]+/mu'                                                  => $separator,
            sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
        ];

        $map = $_transliteration + $merge;
        unset($_transliteration);

        return mb_strtolower(preg_replace(array_keys($map), array_values($map), $string));
    }

    public static function encryptAES($plaintext, $password)
    {
        $method = "AES-256-CBC";
        $key    = hash('sha256', $password, true);
        $iv     = openssl_random_pseudo_bytes(16);

        $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
        $hash       = hash_hmac('sha256', $ciphertext . $iv, $key, true);

        return $iv . $hash . $ciphertext;
    }

    public static function decryptAES($ivHashCiphertext, $password)
    {
        $method     = "AES-256-CBC";
        $iv         = substr($ivHashCiphertext, 0, 16);
        $hash       = substr($ivHashCiphertext, 16, 32);
        $ciphertext = substr($ivHashCiphertext, 48);
        $key        = hash('sha256', $password, true);

        if (! hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) {
            return null;
        }

        return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
    }

    public static function encryptMCRYPT($text, $key)
    {
        $block = mcrypt_get_block_size('rijndael_128', 'ecb');
        $pad   = $block - (strlen($text) % $block);
        $text  .= str_repeat(chr($pad), $pad);

        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $text, MCRYPT_MODE_ECB));
    }

    public static function decryptMCRYPT($str, $key)
    {
        $str   = base64_decode($str);
        $str   = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $str, MCRYPT_MODE_ECB);
        $block = mcrypt_get_block_size('rijndael_128', 'ecb');
        $pad   = ord($str[($len = strlen($str)) - 1]);
        $len   = strlen($str);
        $pad   = ord($str[$len - 1]);

        return substr($str, 0, strlen($str) - $pad);
    }

    public static function encryptMD5($q)
    {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qEncoded      = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
        return($qEncoded);
    }

    public static function decryptItMD5($q)
    {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qDecoded      = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
        return($qDecoded);
    }
}
