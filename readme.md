InboxSearch
===========
Search operators library

Supported operators
-------------------
 - Filename (string)
 - Size (integer)
 - Has (string)
 - From (string)
 - To (string)
 - Subject (string)
 - Label (string)
 - Delivered To (string)
 - After (\DateTime)
 - Before (\DateTime)
 - Older (\DateTime)
 - Newer (\DateTime)
 - In (string)


How to use
----------

```php
$term = 'from:thomas@scullwm.com forum';
$factory = new InboxSearchFactory($term);

//  return InboxSearchInterface
$inboxSearch = $factory->process();

$from = $inboxSearch->getFrom();
```