<?php

namespace Like\Database;

class ConfigBean implements Config {
	const DEFAULT_DRIVER = 'mysql';
	const DEFAULT_FAKER_LANGUAGE = 'pt_BR';

	private $driver;
	private $user;
	private $password;
	private $bd;

	private $factoryFolder;
	private $fakerLanguage = self::DEFAULT_FAKER_LANGUAGE;
	private $fakerProviders = [];

	public function __construct($host, $user, $password, $bd, $driver=self::DEFAULT_DRIVER) {
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
		$this->bd = $bd;
		$this->driver = $driver;
	}

	public function getDriver() {
		return $this->driver;
	}

	public function getHost() {
		return $this->host;
	}

	public function getBd() {
		return $this->bd;
	}

	public function getUser() {
		return $this->user;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getFactoryFolder() {
		return $this->factoryFolder;
	}

	public function getFakerLanguage() {
		return $this->fakerLanguage;
	}

	public function getFakerProviders() {
		return $this->fakerProviders;
	}

	public function setFactoryFolder($src) {
		$this->factoryFolder = $src;
	}

	public function addFakerProvider($class) {
		$this->fakerProviders[] = $class;
	}
}
