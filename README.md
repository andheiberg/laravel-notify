# Notify

A site notification package for laravel.

Currently let's you easily flash notifications to the session. It also supports laravels translation package out of the box.

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

You can also pass a language tag for easy localization.

```php
Notify::success('auth.login-successful'); // Calls Lang::get('auth.login-successful') behind the scene
Notify::warning('auth.verification-email-sent', ['email' => 'test@gmail.com']) // You can also pass replacements
```

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

#### Bootstrap example
```php
@if (Notify::all())
	<div class="container">
		@foreach (Notify::get('success') as $alert)
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				{{ $alert }}
			</div>
		@endforeach

		@foreach (Notify::get('error') as $alert)
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				{{ $alert }}
			</div>
		@endforeach

		@foreach (Notify::get('info') as $alert)
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				{{ $alert }}
			</div>
		@endforeach

		@foreach (Notify::get('warning') as $alert)
			<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				{{ $alert }}
			</div>
		@endforeach
	</div>
@endif
```
