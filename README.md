
[![Build Status](https://travis-ci.org/cleaniquecoders/attendance.svg?branch=master)](https://travis-ci.org/cleaniquecoders/attendance) [![Latest Stable Version](https://poser.pugx.org/cleaniquecoders/attendance/v/stable)](https://packagist.org/packages/cleaniquecoders/attendance) [![Total Downloads](https://poser.pugx.org/cleaniquecoders/attendance/downloads)](https://packagist.org/packages/cleaniquecoders/attendance) [![License](https://poser.pugx.org/cleaniquecoders/attendance/license)](https://packagist.org/packages/cleaniquecoders/attendance)

## About Your Package

This is an Adaptive Attendance package - enabled developers to integrate with existing attendance system and devices such as Access Card, Biometric, etc.

This package comes with common attendance adapaters:

1. Web Adapter - use for Web based attendance system
2. API Adapter - use for Mobile based attendance system
3. Console Adapter - use for Queue based attendance system

See usage section below for custom adapters.

## Installation

1. In order to install `cleaniquecoders/attendance` in your Laravel project, just run the *composer require* command from your terminal:

```
$ composer require cleaniquecoders/attendance
```

2. Then in your `config/app.php` add the following to the providers array:

```php
CleaniqueCoders\Attendance\AttendanceServiceProvider::class,
```

3. In the same `config/app.php` add the following to the aliases array:

```php
'Attendance' => CleaniqueCoders\Attendance\AttendanceFacade::class,
```

4. Install the package:

```
$ php artisan attendance:install
```

5. Setup `AttendanceTrait` to your user model.

```php
<?php

namespace App;

use CleaniqueCoders\Attendance\Traits\AttendanceTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, AttendanceTrait;
...
```

## Usage

### Artisan Commands

Log Attendance from console:

```php
// log user with 1 as time in
$ php artisan attendance:log 1 1

// log user with 1 as time out
$ php artisan attendance:log 1 2

// log user with email hi@attendance.com as time in
$ php artisan attendance:log "hi@attendance.com" 1 "email"

// log user with email hi@attendance.com as time out
$ php artisan attendance:log "hi@attendance.com" 2 "email"
```

### API

When running `attendance:install`, API routes to for attendance will be append into your `routes/api.php` file.

### Scopes

To get all entries for today, you can use `todayEntries()` scope.

```php
\CleaniqueCoders\Attendance\Models\Attendance::todayEntries()->get();
```

To get based on one or more drivers.

```php
\CleaniqueCoders\Attendance\Models\Attendance::todayEntries('web')->get();
\CleaniqueCoders\Attendance\Models\Attendance::todayEntries(['api', 'access-card'])->get();
```

### Custom adapter

You can create custom adapter if you want to have custom integration with Slack, Telegram, etc.

```
$ php artisan make:attendance SlackAdapter --driver=slack
```

This will create a class located at `app/Adapters/SlackAdapter.php`.

```php
<?php 

namespace App\Adapters;

use CleaniqueCoders\Attendance\Models\AttendanceType;

class SlackAdapter extends BaseAdapter
{
	protected $driver = 'slack';

	public function timeIn()
	{
		// your implementation to determine user is time in
		$this->capture(AttendanceType::TIME_IN);
	}

	public function timeOut()
	{
		// your implementation to determine user is time out
		$this->capture(AttendanceType::TIME_OUT);
	}
}
```

Once created, you may want to create routes to accept Slack webhook into your app. Following is an example of route setup.

```php
Route::get('attendance/slack/time-in', function() {
	$user = \App\User::whereSlackId(request()->slack_id)->firstOrFail();
	(new \App\Adapters\SlackAdapter($user, now()))->timeIn();
})->name('attendance.slack.time-in');

Route::get('attendance/slack/time-out', function() {
	$user = \App\User::whereSlackId(request()->slack_id)->firstOrFail();
	(new \App\Adapters\SlackAdapter($user, now()))->timeOut();
})->name('attendance.slack.time-out');
```

## Test

Run the following command:

```
$ vendor/bin/phpunit  --testdox --verbose
```

## Contributing

Thank you for considering contributing to the `cleaniquecoders/attendance`!

### Bug Reports

To encourage active collaboration, it is strongly encourages pull requests, not just bug reports. "Bug reports" may also be sent in the form of a pull request containing a failing test.

However, if you file a bug report, your issue should contain a title and a clear description of the issue. You should also include as much relevant information as possible and a code sample that demonstrates the issue. The goal of a bug report is to make it easy for yourself - and others - to replicate the bug and develop a fix.

Remember, bug reports are created in the hope that others with the same problem will be able to collaborate with you on solving it. Do not expect that the bug report will automatically see any activity or that others will jump to fix it. Creating a bug report serves to help yourself and others start on the path of fixing the problem.

## Coding Style

`cleaniquecoders/attendance` follows the PSR-2 coding standard and the PSR-4 autoloading standard. 

You may use PHP CS Fixer in order to keep things standardised. PHP CS Fixer configuration can be found in `.php_cs`.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).