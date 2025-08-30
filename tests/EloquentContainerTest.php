<?php

namespace Like\Database\Tests;

use Illuminate\Container\Container;
use Like\Database\Config;
use Like\Database\Eloquent;

class EloquentContainerTest extends EloquentTest {
	public static function set_up_before_class(): void {
		Eloquent::destroy();
		self::assertFalse(Eloquent::isLoaded());

		$config = new ConfigBean();
		Container::getInstance()->instance(Config::class, $config);
		self::assertTrue(Container::getInstance()->bound(Config::class));

		Eloquent::init();
	}
}
