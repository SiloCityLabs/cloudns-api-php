ClouDNS API Library
===============================

This is a wrapper library for the ClouDNS API to be used by PHP applications. It tries to ease the integration of the API into your applications by handling all interactions with API and providing a simple interface to interact with.

Getting Started
-------------------------------
To begin using the Library, the cloudns.php must be included in your application.

```php
require_once('/path/to/library/cloudns.php');
```

An instance of the ClouDNS must be created to interact with the library. This Object is the gateway to all interactions with the library. The API password obtained from the [ClouDNS](https://www.cloudns.net/api-settings/) must be passed into the ClouDNS by calling set_options.

```php
$cloudns = new ClouDNS();
$cloudns->set_options(array('auth-id' => '999','auth-password' => 'some_password'));
```

Examples
-------------------------------
Numerous examples have been provided in the repository's examples folder. The examples demonstrate how to accomplish most actions possible in the library. You are encouraged to look at these examples to learn the best practices for using the library.

Reporting Issues/Contributing
-------------------------------
If you find an issue with the library, please report the issue to us by using the repository's issue tracker and we will try to resolve the issue. If you resolve the issue or make other improvements feel free to create a pull request so we can merge it into a future release.