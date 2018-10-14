Clara News
===============

News feature for Clara.

## Installation

```php
composer require ceddyg/clara-news
```

Add to your providers in 'config/app.php'
```php
CeddyG\ClaraNews\NewsServiceProvider::class,
```

Then to publish the files.
```php
php artisan vendor:publish --provider="CeddyG\ClaraNews\NewsServiceProvider"
```
