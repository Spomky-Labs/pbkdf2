<?php

namespace PBKDF2;

/**
 * Class representing a JSON Web Token Manager.
 */
class PBKDF2
{
    /**
     * PBKDF2 key derivation function as defined by RSA's PKCS #5: RFC 2898
     * Test vectors can be found i the RFC 6070
     * This implementation of PBKDF2 was originally created by defuse.ca
     * With improvements by variations-of-shadow.com.
     *
     * @param string $algorithm  The hash algorithm to use. For supported hash algorithms, see hash_algos().
     * @param string $password   The password.
     * @param string $salt       A salt that is unique to the password.
     * @param int    $count      Iteration count. Higher is better, but slower.
     * @param int    $key_length The length of the derived key in bytes.
     * @param bool   $raw_output If true, the result is in binary format, else in hex. Default is false
     *
     * @return string A $key_length-byte key derived from the password and salt.
     *
     * @throws \InvalidArgumentException If algorithm is not supported or if count/key_length parameter are not valid.
     *
     * @see https://www.ietf.org/rfc/rfc2898.txt
     * @see https://www.ietf.org/rfc/rfc6070.txt
     * @see http://php.net/manual/en/function.hash-hmac.php
     */
    public static function deriveKey($algorithm, $password, $salt, $count, $key_length, $raw_output = false)
    {
        if (!in_array($algorithm, hash_algos(), true)) {
            throw new \InvalidArgumentException('PBKDF2 ERROR: Invalid hash algorithm.');
        }
        if ($count <= 0 || $key_length < 0) {
            throw new \InvalidArgumentException('PBKDF2 ERROR: Invalid key length parameters.');
        }

        if (function_exists('hash_pbkdf2')) {
            if (!$raw_output) {
                $key_length = $key_length * 2;
            }

            return hash_pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output);
        }

        $hash_length = strlen(hash($algorithm, '', true));
        if (0 === $key_length) {
            $key_length = $hash_length;
        }
        $block_count = ceil($key_length / $hash_length);

        $output = '';
        for ($i = 1; $i <= $block_count; $i++) {
            $last = $salt.pack('N', $i);
            $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
            for ($j = 1; $j < $count; $j++) {
                $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
            }
            $output .= $xorsum;
        }

        $raw = substr($output, 0, $key_length);

        if ($raw_output) {
            return $raw;
        }

        return bin2hex($raw);
    }
}
