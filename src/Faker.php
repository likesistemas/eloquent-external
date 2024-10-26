<?php

namespace Like\Database;

use Faker\Factory;
use Faker\Generator;
use Faker\Provider\Base;
use Faker\UniqueGenerator;
use ReflectionClass;

class Faker {
	/**
	 * @var UniqueGenerator[]
	 */
	private static $uniques = [];

	/**
	 * @return Generator
	 */
	public static function factory(Config $config) {
		$faker = Factory::create($config->getFakerLanguage());

		foreach ($config->getFakerProviders() as $provider) {
			$faker->addProvider(self::createProvider($faker, $provider));
		}

		return $faker;
	}

	/**
	 * @param Generator $faker
	 * @param string $providerClass
	 *
	 * @return Base
	 */
	private static function createProvider(Generator $faker, $providerClass) {
		$class = new ReflectionClass($providerClass);
		return $class->newInstanceArgs([$faker]);
	}

	public static function unique(Generator $faker, $name, $maxRetries = 10000) {
		if (! isset(self::$uniques[$name])) {
			self::$uniques[$name] = new UniqueGenerator($faker, $maxRetries);
		}

		return self::$uniques[$name];
	}

	public static function resetUnique() {
		self::$uniques = [];
	}
}
