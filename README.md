# Password Based Key Derivation Function 2 (PBKDF2)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Spomky-Labs/pbkdf2/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Spomky-Labs/pbkdf2/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Spomky-Labs/pbkdf2/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Spomky-Labs/pbkdf2/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Spomky-Labs/pbkdf2/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Spomky-Labs/pbkdf2/build-status/master)
[![HHVM Status](http://hhvm.h4cc.de/badge/Spomky-Labs/pbkdf2.png)](http://hhvm.h4cc.de/package/Spomky-Labs/pbkdf2)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a8991b9b-ac35-402f-a3cc-21c89787f840/big.png)](https://insight.sensiolabs.com/projects/a8991b9b-ac35-402f-a3cc-21c89787f840)

[![Latest Stable Version](https://poser.pugx.org/Spomky-Labs/pbkdf2/v/stable.png)](https://packagist.org/packages/Spomky-Labs/pbkdf2) [![Total Downloads](https://poser.pugx.org/Spomky-Labs/pbkdf2/downloads.png)](https://packagist.org/packages/Spomky-Labs/pbkdf2) [![Latest Unstable Version](https://poser.pugx.org/Spomky-Labs/pbkdf2/v/unstable.png)](https://packagist.org/packages/Spomky-Labs/pbkdf2) [![License](https://poser.pugx.org/Spomky-Labs/pbkdf2/license.png)](https://packagist.org/packages/Spomky-Labs/pbkdf2)

This library implements the PBKDF2 algorithm (RFC2898 and RFC6070).

## The Release Process ##

We manage the releases of the library through features and time-based models.

- A new patch version comes out every month when you made backwards-compatible bug fixes.
- A new minor version comes every six months when we added functionality in a backwards-compatible manner.
- A new major version comes every year when we make incompatible API changes.

The meaning of "patch" "minor" and "major" comes from the Semantic [Versioning strategy](http://semver.org/).

This release process applies for all versions.

### Backwards Compatibility

We allow developers to upgrade with confidence from one minor version to the next one.

Whenever keeping backward compatibility is not possible, the feature, the enhancement or the bug fix will be scheduled for the next major version.

## Prerequisites ##

This library needs at least

* `PHP 5.3`

It has been successfully tested using `PHP 5.3` to `PHP 5.6`.

## Installation ##

The preferred way to install this library is to rely on Composer:

    {
        "require": {
            // ...
            "spomky-labs/pbkdf2": "dev-master"
        }
    }

## Extend the library ##

This library only contains the logic. You must extend classes (algorithms, compression, managers...) to define setters and getters.

Look at [Extend classes](doc/Extend.md) for more informations and examples.

## How to use ##

Your classes are ready to use? Have a look at [How to use](doc/Use.md) to create or load your first JWT objects.

## Todo

[Next modifications](doc/Todo.md).

## Contributing

Requests for new features, bug fixed and all other ideas to make this library usefull are welcome. [Please follow these best practices](doc/Contributing.md).

## Licence

This software is release under MIT licence.
