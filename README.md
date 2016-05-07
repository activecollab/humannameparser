# Human Name Parser

[![Build Status](https://travis-ci.org/activecollab/HumanNameParser.svg?branch=master)](https://travis-ci.org/activecollab/HumanNameParser)

Takes human names of arbitrary complexity and various formats and parses initial, first name, last name, middle name, nicknames etc. Example:

```php
use ActiveCollab\HumanNameParser\Parser as HumanNameParser;

$name = new HumanNameParser("Peter O'Toole");

print $name->getFirst();
print $name->getLast();
```

## Running tests

`cd` to this directory and run:

```bash
phpunit
```
