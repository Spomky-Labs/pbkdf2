Password Based Key Derivation Function 2 (PBKDF2)
=================================================

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Spomky-Labs/pbkdf2/badges/quality-score.png?b=release%2Fv1.0.0)](https://scrutinizer-ci.com/g/Spomky-Labs/pbkdf2/?branch=release%2Fv1.0.0)
[![Code Coverage](https://scrutinizer-ci.com/g/Spomky-Labs/pbkdf2/badges/coverage.png?b=release%2Fv1.0.0)](https://scrutinizer-ci.com/g/Spomky-Labs/pbkdf2/?branch=release%2Fv1.0.0)

[![Build Status](https://travis-ci.org/Spomky-Labs/pbkdf2.svg?branch=release%2Fv1.0.0)](https://travis-ci.org/Spomky-Labs/pbkdf2)
[![HHVM Status](http://hhvm.h4cc.de/badge/Spomky-Labs/pbkdf2.png)](http://hhvm.h4cc.de/package/Spomky-Labs/pbkdf2)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a8991b9b-ac35-402f-a3cc-21c89787f840/big.png)](https://insight.sensiolabs.com/projects/a8991b9b-ac35-402f-a3cc-21c89787f840)

[![Latest Stable Version](https://poser.pugx.org/Spomky-Labs/pbkdf2/v/stable.png)](https://packagist.org/packages/Spomky-Labs/pbkdf2) [![Total Downloads](https://poser.pugx.org/Spomky-Labs/pbkdf2/downloads.png)](https://packagist.org/packages/Spomky-Labs/pbkdf2) [![Latest Unstable Version](https://poser.pugx.org/Spomky-Labs/pbkdf2/v/unstable.png)](https://packagist.org/packages/Spomky-Labs/pbkdf2) [![License](https://poser.pugx.org/Spomky-Labs/pbkdf2/license.png)](https://packagist.org/packages/Spomky-Labs/pbkdf2)

This library implements the PBKDF2 algorithm ([RFC2898](http://www.ietf.org/rfc/rfc2898.txt) and [RFC6070](http://www.ietf.org/rfc/rfc6070.txt)).
Please note that if you use PHP 5.5+, this library is useless. From PHP 5.5, you can use `hash_pbkdf2` directly.

## The Release Process ##

The release process [is described here](doc/Release.md).

## Prerequisites ##

This library needs at least `PHP 5.3`.

It has been successfully tested using `PHP 5.3` to `PHP 5.6`, `PHP 7.0` and `HHVM`.

## Installation ##

The preferred way to install this library is to rely on Composer:

    {
        "require": {
            // ...
            "spomky-labs/pbkdf2": "~1.0"
        }
    }

## How to use ##

Take a look at [How to use](doc/Use.md) to use this library.

## Contributing

Requests for new features, bug fixed and all other ideas to make this library useful are welcome. [Please follow these best practices](doc/Contributing.md).

## Licence

This software is release under MIT licence.
