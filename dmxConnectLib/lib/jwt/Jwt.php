<?php

namespace lib\jwt;

class Jwt
{
    public static $algos = array(
        'HS256' => 'sha256',
        'HS384' => 'sha384',
        'HS512' => 'sha512',
        'RS256' => OPENSSL_ALGO_SHA256,
        'RS384' => OPENSSL_ALGO_SHA384,
        'RS512' => OPENSSL_ALGO_SHA512
    );

    private function __construct() {}

    public static function sign($options) {
        $options = (array)$options;
        $header = $options['header'];
        $payload = $options['payload'];
        $key = $options['key'];
        $algo = $header['alg'];

        $header = self::encode($header);
        $payload = self::encode($payload);
        $signature = self::encode(self::signature($header . '.' . $payload, $algo, $key));

        return $header . '.' . $payload . '.' . $signature;
    }

    private static function signature($data, $algo, $key) {
        if (substr($algo, 0, 2) === 'HS') {
            return hash_hmac(self::$algos[$algo], $data, $key, true);
        }

        openssl_sign($data, $signature, openssl_get_privatekey($key), self::$algos[$algo]);

        return $signature;
    }

    private static function encode($data) {
        if (\is_array($data)) {
            $data = json_encode($data, JSON_UNESCAPED_SLASHES);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("JSON failed: " . json_last_error_msg());
            }
        }

        return self::base64url($data);
    }

    private static function base64url($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}