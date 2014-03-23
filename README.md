# Notify

A highly extendable notification system with laravel integration.

## Table of Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
    - [Adding Notifications](#adding-notifications)
    - [Displaying Notifications](#displaying-notifications)

## Installation

You can install the package for your Laravel 4 project through Composer.

Require the package in your `composer.json`.

```
"andheiberg/notify": "1.*"
```

Run composer to install or update the package.

```bash
$ composer update
```

Register the service provider in `app/config/app.php`.

```php
'Andheiberg\Notify\NotifyServiceProvider',
```

Add the alias to the list of aliases in `app/config/app.php`.

```php
'Notify' => 'Andheiberg\Notify\Facades\Notify',
```

## Configuration

The packages provides you with some configuration options.

To create the configuration file run this command in your command line app:

```bash
$ php artisan config:publish andheiberg/notify
```

The configuration file will be published here: `app/config/packages/andheiberg/notify/config.php`.

## Usage

### Adding Notifications

By default, the package has some notification types defined in its configuration file. The default types are `success`, `error`, `warning` and `info`.

Every type can be called as a function.

```php
Notify::info('This is an info message.');
Notify::error('Whoops, something has gone wrong.');
```

You can of course add your own types by adding them to your own config file. [See above](#configuration) on how to publish the config file.

### Displaying Notifications

`Notify` class is just an extension of Illuminate's `MessageBag` class, which means we can use all of its functionality to display messages.

```php
@foreach (Notify::all() as $notification)
    {{ $notification }}
@endforeach
```

Or if you'd like to display a single notification for a certain level.

```php
@if (Notify::has('success'))
    {{ Notify::first('success') }}
@endif
```

If you'd like to learn more ways on how you can display messages, please [take a closer look to Illuminate's `MessageBag` class](https://github.com/illuminate/support/blob/master/MessageBag.php).