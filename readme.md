InboxSearch
===========
Search operators library.
See more from Gmail: https://support.google.com/mail/answer/7190?hl=en

## Supported operators
 - Filename (string)
 - Size (integer - convert string in bytes)
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


## How to use

```php
$term = 'from:thomas@scullwm.com forum';
$factory = new InboxSearchFactory($term);

//  return InboxSearchInterface
$inboxSearch = $factory->process();

$from    = $inboxSearch->getFrom(); // thomas@scullwm.com
$keyword = $inboxSearch->getKeyword(); // array('from' => 'forum')

$fromKeyword = $inboxSearch->getKeywordFor(InboxSearchInterface::FILTER_FROM); // forum
```


## Create your own filter
Filter must implement `FilterInterface`.
Then register the filter in your factory instance
```php

$factory = new InboxSearchFactory($term);

$myFilterParserFqcn = 'Swm\InboxSearch\FilterModel\MyCustomFilter';
$factory->addFilterParser($myFilterParserFqcn);

```

## Tests

```shell
php composer install --dev
bin/atoum -d tests/units
```