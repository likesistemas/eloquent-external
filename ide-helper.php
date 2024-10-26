<?php

use Like\Database\Eloquent;
use Like\Database\Tests\ConfigBean;
use Like\Eloquent\IdeHelper\Config;

Eloquent::init(new ConfigBean());

return new Config([
	'ide-helper.model_locations' => [
		'tests/Models/',
	],
]);
