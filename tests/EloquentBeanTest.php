<?php

namespace Like\Database\Tests;

use Like\Database\Eloquent;

class EloquentBeanTest extends EloquentTest {
	public static function set_up_before_class() {
		Eloquent::destroy();
		self::assertFalse(Eloquent::isLoaded());

		Eloquent::init(new ConfigBean());
	}
}
