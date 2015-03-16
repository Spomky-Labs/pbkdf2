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
     * @param string  $algorithm  The hash algorithm to use. For supported hash algorithms, see hash_algos().
     * @param string  $password   The password.
     * @param string  $salt       A salt that is unique to the password.
     * @param integer $count      Iteration count. Higher is better, but slower.
     * @param integer $key_length The length of the derived key in bytes.
     *
     * @return string A $key_length-byte key derived from the password and salt.
     *
     * @throws \InvalidArgumentException If algorithm is not supported or if count/key_length parameter are not valid.
     *
     * @see https://www.ietf.org/rfc/rfc2898.txt
     * @see https://www.ietf.org/rfc/rfc6070.txt
     * @see http://php.net/manual/en/function.hash-hmac.php
     */
    public static function deriveKey($algorithm, $password, $salt, $count, $key_length)
    {
        $algorithm = strtolower($algorithm);
        if (!in_array($algorithm, hash_algos(), true)) {
            throw new \InvalidArgumentException('PBKDF2 ERROR: Invalid hash algorithm.');
        }
        if ($count <= 0 || $key_length <= 0) {
            throw new \InvalidArgumentException('PBKDF2 ERROR: Invalid parameters.');
        }

        $hash_length = strlen(hash($algorithm, "", true));
        $block_count = ceil($key_length / $hash_length);

        $output = "";
        for ($i = 1; $i <= $block_count; $i++) {
            $last = $salt.pack("N", $i);
            $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
            for ($j = 1; $j < $count; $j++) {
                $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
            }
            $output .= $xorsum;
        }

        return substr($output, 0, $key_length);
    }
}
