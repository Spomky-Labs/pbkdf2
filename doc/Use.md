How to use
==========

To use this random string generator, you just have to call the static method `getRandomString` of the class `Security\DefuseGenerator`.

```php
<?php

use Security\DefuseGenerator;

DefuseGenerator::getRandomString(10); // Create a random string with 10 characters
```

By default, this generator uses the following charset: `ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-._~+/`.
You can change this charset if needed by passing your custom charset as second argument.

```php
use Security\DefuseGenerator;

DefuseGenerator::getRandomString(10, "ABCDEFGHIJKLMNOPQRSTUVWXYZ"); // Create a random string with 10 characters. Characters are within A-Z only.
```
