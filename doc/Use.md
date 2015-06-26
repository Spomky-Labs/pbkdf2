How to use
==========

This library provides a class with a single method: `PBKDF2::deriveKey`. Arguments are the same as native PHP [`hash_pbkdf`](http://php.net/manual/en/function.hash-pbkdf2.php).

```php
<?php

use Security\DefuseGenerator;

PBKDF2::deriveKey("sha256", "Password to derive", "A salt", 1000, 100, false);
```
