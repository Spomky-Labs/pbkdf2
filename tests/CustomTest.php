<?php

namespace PBKDF2\tests;

use PBKDF2\PBKDF2;

class CustomTest extends \PHPUnit_Framework_TestCase
{
    public function testVector0()
    {
        $algorithm = 'md5';
        $password  = 'password';
        $salt      = 'salt';
        $count     = 1;
        $hex_expected  = 'f31afb6d931392daa5e3130f47f9a9b6e8e72029d8350b9fb27a9e0e00b9d9915a5f18928639ca8bbc3d1c1cb66d4f27b9df';
        $raw_expected  = pack('H*', $hex_expected);

        $this->assertSame($raw_expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, 50, true));
        $this->assertSame($raw_expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, 50, true, false));
        $this->assertSame($hex_expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, 50, false, false));
    }

    public function testVector1()
    {
        $algorithm = 'sha256';
        $password  = 'password';
        $salt      = 'salt';
        $count     = 1;
        $hex_expected  = '120fb6cffcf8b32c43e7225256c4f837a86548c92ccc35480805987cb70be17b';
        $raw_expected  = pack('H*', $hex_expected);

        $this->assertSame($raw_expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, 0, true));
        $this->assertSame($raw_expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, 0, true, false));
        $this->assertSame($hex_expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, 0, false, false));
    }

    public function testVector2()
    {
        $algorithm = 'sha512';
        $password  = 'password';
        $salt      = 'salt';
        $count     = 2;
        $hex_expected  = 'e1d9c16aa681708a45f5c7c4e215ceb66e011a2e9f0040713f18aefdb866d53cf76cab2868a39b9f7840edce4fef5a82be67335c77a6068e04112754f27ccf4e';
        $raw_expected  = pack('H*', $hex_expected);

        $this->assertSame($raw_expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, 0, true));
        $this->assertSame($raw_expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, 0, true, false));
        $this->assertSame($hex_expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, 0, false, false));
    }

    public function testVector3()
    {
        $algorithm = 'md2';
        $password  = 'password';
        $salt      = 'salt';
        $count     = 4096;
        $hex_expected  = '71f64353e1c9af0564da05d554aeafe7';
        $raw_expected  = pack('H*', $hex_expected);

        $this->assertSame($raw_expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, 0, true));
        $this->assertSame($raw_expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, 0, true, false));
        $this->assertSame($hex_expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, 0, false, false));
    }

    public function testVector4()
    {
        $algorithm = 'whirlpool';
        $password  = 'password';
        $salt      = 'salt';
        $count     = 1000;
        $hex_expected  = '5ad7361484c7dde6b23e573c4b61d1fd16023fd6c0170d0b26d70f7ac8c683f06e767804750357b4032297c2ad36cbd84d01476c1298826b71f605dbcda9e055';
        $raw_expected  = pack('H*', $hex_expected);

        $this->assertSame($raw_expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, 0, true));
        $this->assertSame($raw_expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, 0, true, false));
        $this->assertSame($hex_expected, PBKDF2::deriveKey($algorithm, $password, $salt, $count, 0, false, false));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage PBKDF2 ERROR: Invalid key length parameters.
     */
    public function testVector5()
    {
        $algorithm = 'whirlpool';
        $password  = 'password';
        $salt      = 'salt';
        $count     = 1000;

        PBKDF2::deriveKey($algorithm, $password, $salt, $count, -1, true, false);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage PBKDF2 ERROR: Invalid hash algorithm.
     */
    public function testVector6()
    {
        $algorithm = 'foo';
        $password  = 'password';
        $salt      = 'salt';
        $count     = 1000;

        PBKDF2::deriveKey($algorithm, $password, $salt, $count, -1, true, false);
    }
}
