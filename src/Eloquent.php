<?php

namespace Like\Database;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Factory;

class Eloquent {

	/**
	 * @var Factory
	 */
	private static $factory;

	public static function init(Config $config) {
		static $loaded;

		if ($loaded === true) {
			return;
		}

		self::initEloquent($config);
		self::$factory = self::createFactory($config);
		self::loadFactorys($config);

		$loaded = true;
	}

	private static function initEloquent(Config $config) {
		$capsule = new Capsule();
		$capsule->addConnection([
			'driver' => 'mysql',
			'host' => $config->getHost(),
			'database' => $config->getBd(),
			'username' => $config->getUser(),
			'password' => $config->getPassword(),
		]);
		$capsule->bootEloquent();
	}

	private static function createFactory(Config $config) {
		$factory = new Factory(Faker::factory($config));
		return $factory;
	}

	private static function loadFactorys(Config $config) {
		self::$factory->load($config->getFactoryFolder());
	}

	/**
	 * @return Factory
	 */
	public static function factory() {
		return self::$factory;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\FactoryBuilder
	 */
	public static function factoryOf(...$arguments) {
		if (isset($arguments[1]) && is_string($arguments[1])) {
			// @phpstan-ignore-next-line
			return self::factory()->of($arguments[0], $arguments[1])->times(! empty($arguments[2]) ? $arguments[2] : null);
		} elseif (isset($arguments[1])) {
			return self::factory()->of($arguments[0])->times($arguments[1]);
		}
		return self::factory()->of($arguments[0]);
	}
}
