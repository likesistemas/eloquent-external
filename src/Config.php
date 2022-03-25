<?php

namespace Like\Database;

interface Config {
	public function getDriver();
	public function getHost();
	public function getBd();
	public function getUser();
	public function getPassword();
	public function getFactoryFolder();
	public function getFakerLanguage();
	public function getFakerProviders();
}
