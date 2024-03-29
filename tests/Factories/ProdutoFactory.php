<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Like\Database\Eloquent;
use Like\Database\Faker as DatabaseFaker;
use Like\Database\Tests\Models\Produto;
use Like\Database\Tests\Models\Subcategoria;

$factory = Eloquent::factory();

$factory->define(Subcategoria::class, function (Faker $faker) {
	return [
		'nome' => $faker->name,
	];
});

$factory->define(Produto::class, function (Faker $faker) {
	return [
		'nome' => $faker->name,
		'valor' => 10,
		'referencia' => DatabaseFaker::unique($faker, 'referenciaProduto')->numberBetween(1, 100),
	];
});

$factory->state(Produto::class, Produto::REFRIGERANTE, function (Faker $faker) {
	return [

		'nome' => $faker->refrigerante(), // @phpstan-ignore-line
		'valor' => $faker->randomFloat(2, 4, 10),
	];
});

$factory->state(Produto::class, Produto::CERVEJA, function (Faker $faker) {
	return [
		'nome' => $faker->cerveja(), // @phpstan-ignore-line
		'valor' => $faker->randomFloat(2, 5, 12),
	];
});
