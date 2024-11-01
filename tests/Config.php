<?php

namespace Like\Database\Tests;

use Like\Database\Config as DatabaseConfig;
use Like\Database\Tests\FakerProviders\ProdutoProvider;

class Config implements DatabaseConfig {
	const DRIVER = 'mysql';
	const HOST = 'mysql';
	const USER = 'root';
	const PASSWORD = 'root';
	const DB = 'eloquent';
	const FACTORY_FOLDER = __DIR__ . '/./Factories/';
	const FAKER_LANGUAGE = 'pt_BR';
	const FAKER_PROVIDER = ProdutoProvider::class;

	public function getDriver() {
		return self::DRIVER;
	}

	public function getHost() {
		return self::HOST;
	}

	public function getDb() {
		return self::DB;
	}

	public function getUser() {
		return self::USER;
	}

	public function getPassword() {
		return self::PASSWORD;
	}

	public function getFactoryFolder() {
		return self::FACTORY_FOLDER;
	}

	public function getCollation() {
		return null;
	}

	public function getCharset() {
		return null;
	}

	public function getFakerLanguage() {
		return self::FAKER_LANGUAGE;
	}

	public function getFakerProviders() {
		return [
			self::FAKER_PROVIDER,
		];
	}
}
