# Using Guzzle in a WordPress plug-in with PHP-Prefixer

**Using prefixed Guzzle with PHP-Prefixer** plug-in for WordPress. A plug-in to showcase the PHP-Prefixer service and how to use Guzzle in the WordPress Ecosystem.

## About the Plugin

A plug-in to integrate Guzzle, PHP HTTP client, in a WordPress plug-in with PHP-Prefixer. The plug-in shows a number fact from numbersapi.com using Guzzle as HTTP client. It is inspired by the Hello Dolly plug-in.

## About PHP-Prefixer

It’s super quick to get a [PHP-Prefixer](https://php-prefixer.com/) project up and running. Install any library freely. PHP-Prefixer will manage your namespaces.

- **Use the same libraries across all platforms**: Develop your solutions using the same libraries for all the platforms you work in, specifically WordPress, Joomla, Drupal, Laravel, Symfony, Slim Framework, etc.
- **Composer + WordPress**: Use Composer for your WordPress projects. PHP-Prefixer will process the dependencies to run smoothly along with other third-party plug-ins.
- **Fully integrated with Git**: Declare your name space configuration and let the service produce the packages. No local installation. No Phars. No new dependencies.

## About Guzzle, PHP HTTP client

Guzzle is a PHP HTTP client that makes it easy to send HTTP requests and trivial to integrate with web services. For more information, please, visit <https://docs.guzzlephp.org/en/stable/index.html>

## How PHP Prefixing works

[PHP-Prefixer](https://php-prefixer.com/) service works based on the following `composer.json` schema definition:

```json
...
    "extra": {
        "php-prefixer": {
            "project-name": "Using Guzzle in a WordPress plug-in with PHP-Prefixer",
            "namespaces-prefix": "PPP",
            "global-scope-prefix": "PPP_",
            "exclude-paths": [
                "bin/"
            ]
        }
    },
...
```

This repository has an action `.github/workflows/prefix.yml` to execute the process to prefix the PHP code:

```yml
name: PHP-Prefixer

on: [workflow_dispatch]

jobs:
  build:
    runs-on: ubuntu-latest

    steps:
      - name: Checkout
        uses: actions/checkout@v2

      - name: Run PHP-Prefixer
        uses: PHP-Prefixer/php-prefixer-build-action@main
        env:
          GH_TOKEN: ${{ secrets.GITHUB_TOKEN }}
        with:
          personal_access_token: ${{ secrets.PERSONAL_ACCESS_TOKEN }}
          project_id: ${{ secrets.PROJECT_ID }}
```

To know more about how PHP-Prefixer service can be configured for a WordPress plug-in, check the following article:

- [New Tutorial: Using PHP Composer in the WordPress Ecosystem](https://blog.php-prefixer.com/2020/10/23/new-tutorial-using-php-composer-in-the-wordpress-ecosystem/)

## References

- Blog: [New Tutorial: Using PHP Composer in the WordPress Ecosystem](https://blog.php-prefixer.com/2020/10/23/new-tutorial-using-php-composer-in-the-wordpress-ecosystem/)
- Documentation: [How to Prefix a WordPress Plugin](https://php-prefixer.com/docs/guides/how-to-prefix-wordpress-plugin/)

## License

GNU GENERAL PUBLIC LICENSE Version 3 License

## Copyright

Copyright (c) 2021 Desarrollos Inteligentes Virtuales, SL
