<?php

namespace PBKDF2\tests;

use PBKDF2\PBKDF2;

/**
 * @see https://www.ietf.org/rfc/rfc6070.txt
 */
class VectorTest extends \PHPUnit_Framework_TestCase
{
    public function testVector1()
    {
        $algorithm = "sha1";
        $password  = "password";
        $salt      = "salt";
        $count     = 1;
        $dkLen     = 20;
        $expected  = pack("H*", "0c60c80f961f0e71f3a9b524af6012062fe037a6");

        $this->assertSame($expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, $dkLen));
    }

    public function testVector2()
    {
        $algorithm = "sha1";
        $password  = "password";
        $salt      = "salt";
        $count     = 2;
        $dkLen     = 20;
        $expected  = pack("H*", "ea6c014dc72d6f8ccd1ed92ace1d41f0d8de8957");

        $this->assertSame($expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, $dkLen));
    }

    public function testVector3()
    {
        $algorithm = "sha1";
        $password  = "password";
        $salt      = "salt";
        $count     = 4096;
        $dkLen     = 20;
        $expected  = pack("H*", "4b007901b765489abead49d926f721d065a429c1");

        $this->assertSame($expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, $dkLen));
    }

    public function testVector4()
    {
        $algorithm = "sha1";
        $password  = "password";
        $salt      = "salt";
        $count     = 16777216;
        $dkLen     = 20;
        $expected  = pack("H*", "eefe3d61cd4da4e4e9945b3d6ba2158c2634e984");

        $this->assertSame($expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, $dkLen));
    }

    public function testVector5()
    {
        $algorithm = "sha1";
        $password  = "passwordPASSWORDpassword";
        $salt      = "saltSALTsaltSALTsaltSALTsaltSALTsalt";
        $count     = 4096;
        $dkLen     = 25;
        $expected  = pack("H*", "3d2eec4fe41c849b80c8d83662c0e44a8b291a964cf2f07038");

        $this->assertSame($expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, $dkLen));
    }

    public function testVector6()
    {
        $algorithm = "sha1";
        $password  = "pass\x00word";
        $salt      = "sa\x00lt";
        $count     = 4096;
        $dkLen     = 16;
        $expected  = pack("H*", "56fa6aa75548099dcc37d7f03425e0c3");

        $this->assertSame($expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, $dkLen));
    }
}
