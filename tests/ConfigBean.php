<?php

namespace Like\Database\Tests;

use Like\Database\ConfigBean as DatabaseConfigBean;

class ConfigBean extends DatabaseConfigBean {
	public function __construct() {
		parent::__construct(
			Config::HOST,
			Config::USER,
			Config::PASSWORD,
			Config::DB
		);

		$this->setFactoryFolder(Config::FACTORY_FOLDER);
		$this->addFakerProvider(Config::FAKER_PROVIDER);
	}
}
