<?php

namespace Like\Database\Tests\FakerProviders;

use Faker\Provider\Base;

class ProdutoProvider extends Base {
	const REFRIGERANTES = [
		'Coca-Cola',
		'Coca-Cola Zero',
		'Fanta Laranja',
		'Fanta Uva',
		'Fanta Guarana',
		'Sprite',
		'Guarana Kuat',
	];

	const CERVEJAS = [
		'Chopp Brahma',
		'Bavaria',
		'Bohemia',
		'Crystal',
		'Kaiser',
		'Itaipava',
		'Schin',
		'Antarctica',
		'Brahma',
		'Skol',
	];

	public function refrigerante() {
		return $this->randomElement(self::REFRIGERANTES);
	}

	public function cerveja() {
		return $this->randomElement(self::CERVEJAS);
	}
}
