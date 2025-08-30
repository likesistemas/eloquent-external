<?php

namespace Like\Database;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

class Eloquent {
	private static bool $loaded = false;
	private static ?LegacyFactory $factory = null;

	public static function init(?Config $config = null): void {
		if (self::$loaded) {
			return;
		}

		if (!$config instanceof Config && Container::getInstance()->bound(Config::class)) {
			$config = Container::getInstance()
				->make(Config::class);
		}

		self::initEloquent($config);
		self::$factory = self::createFactory($config);
		self::loadFactorys($config);

		self::$loaded = true;
	}

	public static function destroy(): void {
		self::$factory = null;
		self::$loaded = false;
	}

	public static function isLoaded(): bool {
		return self::$loaded;
	}

	private static function initEloquent(Config $config): void {
		$capsule = new Capsule();
		$capsule->addConnection(self::getConfigConnection($config));
		$capsule->setEventDispatcher(
			new Dispatcher(
				Container::getInstance()
			)
		);
		$capsule->bootEloquent();
	}

	private static function getConfigConnection(Config $config): array {
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

	private static function createFactory(Config $config): LegacyFactory {
		return new LegacyFactory(Faker::factory($config));
	}

	private static function loadFactorys(Config $config): void {
		self::$factory->load($config->getFactoryFolder());
	}

	/**
	 * @return LegacyFactory
	 */
	public static function factory(): ?LegacyFactory {
		return self::$factory;
	}

	/**
	 * @return LegacyFactoryBuilder
	 */
	public static function factoryOf(...$arguments) {
		if (isset($arguments[1]) && is_string($arguments[1])) {
			return self::factory()
				->of($arguments[0])
				->times($arguments[2] ?? null);
		} elseif (isset($arguments[1])) {
			return self::factory()
				->of($arguments[0])
				->times($arguments[1]);
		}
		return self::factory()->of($arguments[0]);
	}
}
