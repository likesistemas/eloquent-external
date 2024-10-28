<?php

namespace Like\Database;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Events\Dispatcher;

class Eloquent {
	/**
	 * @var boolean
	 */
	private static $loaded;

	/**
	 * @var Factory|null
	 */
	private static $factory = null;

	public static function init(Config $config = null) {
		if (self::$loaded === true) {
			return;
		}

		if ($config === null && Container::getInstance()->bound(Config::class)) {
			$config = Container::getInstance()
				->make(Config::class);
		}

		self::initEloquent($config);
		self::$factory = self::createFactory($config);
		self::loadFactorys($config);

		self::$loaded = true;
	}

	public static function destroy() {
		self::$factory = null;
		self::$loaded = false;
	}

	public static function isLoaded() {
		return self::$loaded;
	}

	private static function initEloquent(Config $config) {
		$capsule = new Capsule();
		$capsule->addConnection(self::getConfigConnection($config));
		$capsule->setEventDispatcher(
			new Dispatcher(
				Container::getInstance()
			)
		);
		$capsule->bootEloquent();
	}

	private static function getConfigConnection(Config $config) {
		$cfg = [
			'driver' => 'mysql',
			'host' => $config->getHost(),
			'database' => $config->getDb(),
			'username' => $config->getUser(),
			'password' => $config->getPassword(),
		];

		if ($config->getCharset()) {
			$cfg['charset'] = $config->getCharset();
		}

		if ($config->getCollation()) {
			$cfg['collation'] = $config->getCollation();
		}

		return $cfg;
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
			return self::factory()->of($arguments[0], $arguments[1])->times(! empty($arguments[2]) ? $arguments[2] : null);
		} elseif (isset($arguments[1])) {
			return self::factory()->of($arguments[0])->times($arguments[1]);
		}
		return self::factory()->of($arguments[0]);
	}
}
