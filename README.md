# UX autoComplete.js

UX autoComplete.js is a Symfony bundle integrating the [autoComplete.js](https://tarekraafat.github.io/autoComplete.js/#/) library in Symfony applications. It is part of [the Symfony UX initiative](https://symfony.com/ux).

## Installation

UX autoComplete.js requires PHP 7.4+ and Symfony 4.4+.

Install this bundle using Composer and Symfony Flex:

```sh
composer require kreemer/ux-autocomplete-js

# Don't forget to install the JavaScript dependencies as well and compile
yarn install --force
yarn encore dev
```

Also make sure you have at least version 2.0 of [@symfony/stimulus-bridge](https://github.com/symfony/stimulus-bridge) in your `package.json` file.

## Usage

### Extend the default behavior

## Run tests

### PHP tests

```sh
php vendor/bin/phpunit
```

### JavaScript tests

```sh
cd Resources/assets
yarn test
```