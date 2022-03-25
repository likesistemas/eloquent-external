<?php

namespace Like\Database;

interface Config {
	
	/**
	 * @return string
	 */
	public function getDriver();

	/**
	 * @return string
	 */
	public function getHost();
	
	/**
	 * @return string
	 */
	public function getDb();

	/**
	 * @return string
	 */
	public function getUser();

	/**
	 * @return string
	 */
	public function getPassword();

	/**
	 * Folder where the factorys are.
	 *
	 * @return string
	 */
	public function getFactoryFolder();

	/**
	 * Language the fake will use.
	 *
	 * @return string
	 */
	public function getFakerLanguage();

	/**
	 * Providers that will be added to Faker.
	 *
	 * @return array
	 */
	public function getFakerProviders();
}
