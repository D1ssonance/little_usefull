## Unique URL helper for CodeIgniter

This helper check avaliability of @param string $addr in your DB and add counter if found the same.

##### Example:

my-super-unique-string //which you want to use in URL or somewhere else
if this string already in DB helper makes: 
my-super-unique-string-1
my-super-unique-string-2
...
And so on.

##### Usage

Place `uniqueurl_helper.php` into /system/helpers/ in your CI project, enable in config and use function like:

```php
$title = 'Some extremely unique title for my post';
$uniqueUrlFromTitle = makeUniqueURL($title, 'posts', 'addr');
```

This helper uses functions from CI url and text helpers, so you should to enable them in config/autoload.php

Minimum config to use helper:
`$autoload['helper'] = array('url', 'text', 'uniqueurl');`
To change separator (default is '-' like in 'default-separator-url-671') in row 19 change '-' to '_' to use underscore.

##### Params
`@param string $addr` - string you need to use in url.
`@param string $table` - table where could be stored this url and where could be the same urls.
`@param string $column` - name of column in $table with url.
`@return string $addr` - transliterated, converted to usable in url string with additional counter if function found same string in database.