# [Eloquent] Using Eloquent without any dependency on Laravel Framework [![CI](https://github.com/likesistemas/eloquent-external/actions/workflows/ci.yml/badge.svg)](https://github.com/likesistemas/eloquent-external/actions/workflows/ci.yml)

## Installation

```
composer require likesistemas/eloquent-external --dev
```

### How to use

#### Using class `ConfigBean`

```php

use Illuminate\Container\Container;
use Like\Database\Config;
use Like\Database\ConfigBean;
use Like\Database\Eloquent;

$config = new ConfigBean(
  'host',
  'user',
  'password',
  'db_name'
);
$config->setFactoryFolder(__DIR__ . "/./factories/"); # Folder where all the Eloquent factories are.
$config->addFakerProvider(ProdutoProvider::class); # Optional. Use to add new providers to Faker. Note: you can add as many as you like.

# If you are configuring the settings in the same file that will start, you can pass the config by parameter.
Eloquent::init($config);

# Or set using `illuminate\container` and run init without parameter.
Container::getInstance()->instance(Config::class, $config);
# Then call `init` wherever you think is best, without having to pass parameters.
Eloquent::init();

```