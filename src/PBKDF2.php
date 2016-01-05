<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace PBKDF2;

/**
 * Class representing a JSON Web Token Manager.
 */
final class PBKDF2
{
    /**
     * PBKDF2 key derivation function as defined by RSA's PKCS #5: RFC 2898
     * Test vectors can be found in the RFC 6070
     * This implementation of PBKDF2 was originally created by defuse.ca
     * With improvements by variations-of-shadow.com.
     *
     * @param string $algorithm          The hash algorithm to use. For supported hash algorithms, see hash_algos().
     * @param string $password           The password.
     * @param string $salt               A salt that is unique to the password.
     * @param int    $count              Iteration count. Higher is better, but slower.
     * @param int    $key_length         The length of the derived key in bytes. Default is 0 (means the length is 1-block).
     * @param bool   $raw_output         If true, the result is in binary format, else in hex. Default is false.
     * @param bool   $native_php_enabled If true and PHP >= 5.5, this function will use the native PHP function, else, this implementation.
     *
     * @return string A $key_length-byte key derived from the password and salt.
     *
     * @see https://www.ietf.org/rfc/rfc2898.txt
     * @see https://www.ietf.org/rfc/rfc6070.txt
     * @see http://php.net/manual/en/function.hash-hmac.php
     * @see http://php.net/manual/en/function.hash-pbkdf2.php
     */
    public static function deriveKey($algorithm, $password, $salt, $count, $key_length = 0, $raw_output = false, $native_php_enabled = true)
    {
        if (function_exists('hash_pbkdf2') && $native_php_enabled) {
            return self::nativePBKDF2($algorithm, $password, $salt, $count, $key_length, $raw_output);
        }

        self::checkArguments($algorithm, $count, $key_length);
        
        $raw = self::customPBKDF2($algorithm, $password, $salt, $count, $key_length);

        return true === $raw_output?$raw:bin2hex($raw);
    }

    /**
     * Pure PHP PBKDF2 key derivation function.
     *
     * @param string $algorithm  The hash algorithm to use. For supported hash algorithms, see hash_algos().
     * @param string $password   The password.
     * @param string $salt       A salt that is unique to the password.
     * @param int    $count      Iteration count. Higher is better, but slower.
     * @param int    $key_length The length of the derived key in bytes.
     *
     * @return string A $key_length-byte key derived from the password and salt.
     */
    private static function customPBKDF2($algorithm, $password, $salt, $count, $key_length)
    {
        $hash_length = strlen(hash($algorithm, '', true));
        if (0 === $key_length) {
            $key_length = $hash_length;
        }
        $block_count = ceil($key_length / $hash_length);

        $output = '';
        for ($i = 1; $i <= $block_count; ++$i) {
            $last = $salt.pack('N', $i);
            $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
            for ($j = 1; $j < $count; ++$j) {
                $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
            }
            $output .= $xorsum;
        }

        return substr($output, 0, $key_length);
    }

    /**
     * Native PHP PBKDF2 key derivation function.
     *
     * @param string $algorithm  The hash algorithm to use. For supported hash algorithms, see hash_algos().
     * @param string $password   The password.
     * @param string $salt       A salt that is unique to the password.
     * @param int    $count      Iteration count. Higher is better, but slower.
     * @param int    $key_length The length of the derived key in bytes.
     * @param bool   $raw_output If true, the result is in binary format, else in hex. Default is false
     *
     * @return string A $key_length-byte key derived from the password and salt.
     */
    private static function nativePBKDF2($algorithm, $password, $salt, $count, $key_length, $raw_output)
    {
        if (!$raw_output) {
            $key_length = $key_length * 2;
        }

        return hash_pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output);
    }

    /**
     * Native PHP PBKDF2 key derivation function.
     *
     * @param string $algorithm  The hash algorithm to use. For supported hash algorithms, see hash_algos().
     * @param int    $count      Iteration count. Higher is better, but slower.
     * @param int    $key_length The length of the derived key in bytes.
     *
     * @throws \InvalidArgumentException If algorithm is not supported or if count/key_length parameter are not valid.
     */
    private static function checkArguments($algorithm, $count, $key_length)
    {
        if (!in_array($algorithm, hash_algos(), true)) {
            throw new \InvalidArgumentException('PBKDF2 ERROR: Invalid hash algorithm.');
        }
        if ($count <= 0 || $key_length < 0) {
            throw new \InvalidArgumentException('PBKDF2 ERROR: Invalid key length parameters.');
        }
    }
}
