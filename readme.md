InboxSearch
===========
Search operators library

Supported operators
-------------------
 - Filename
 - Size
 - Has
 - From
 - To
 - Subject
 - Label
 - Delivered To
 - After
 - Before
 - Older
 - Newer
 - In


How to use
----------

```php
$term = 'from:thomas@scullwm.com forum';
$factory = new InboxSearchFactory($term);

//  return InboxSearchInterface
$inboxSearch = $factory->process();

$from = $inboxSearch->getFrom();
```