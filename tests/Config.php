<?php

namespace Like\Database\Tests;

use Like\Database\Config as DatabaseConfig;
use Like\Database\Tests\FakerProviders\ProdutoProvider;

class Config implements DatabaseConfig {
	public function getDriver() {
		return 'mysql';
	}

	public function getHost() {
		return 'mysql';
	}

	public function getBd() {
		return 'eloquent';
	}

	public function getUser() {
		return 'root';
	}

	public function getPassword() {
		return 'root';
	}

	public function getFactoryFolder() {
		return __DIR__ . '/./Factories/';
	}

	public function getFakerLanguage() {
		return 'pt_BR';
	}

	public function getFakerProviders() {
		return [
			ProdutoProvider::class,
		];
	}
}
