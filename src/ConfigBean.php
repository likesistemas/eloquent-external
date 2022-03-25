<?php

namespace Like\Database;

class ConfigBean implements Config {
	const DEFAULT_DRIVER = 'mysql';
	const DEFAULT_FAKER_LANGUAGE = 'pt_BR';

	/**
	 * @var string
	 */
	private $driver;

	/**
	 * @var string
	 */
	private $host;

	/**
	 * @var string
	 */
	private $user;

	/**
	 * @var string
	 */
	private $password;

	/**
	 * @var string
	 */
	private $db;

	/**
	 * Folder where the factorys are.
	 *
	 * @var string
	 */
	private $factoryFolder;

	/**
	 * Language the fake will use.
	 *
	 * @var string
	 */
	private $fakerLanguage = self::DEFAULT_FAKER_LANGUAGE;

	/**
	 * Providers that will be added to Faker.
	 *
	 * @var array
	 */
	private $fakerProviders = [];

	/**
	 * @param string $host
	 * @param string $user
	 * @param string $password
	 * @param string $db
	 * @param string $driver
	 */
	public function __construct($host, $user, $password, $db, $driver=self::DEFAULT_DRIVER) {
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
		$this->db = $db;
		$this->driver = $driver;
	}

	public function getDriver() {
		return $this->driver;
	}

	public function getHost() {
		return $this->host;
	}

	public function getDb() {
		return $this->db;
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
