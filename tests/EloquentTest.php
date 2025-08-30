<?php

namespace Like\Database\Tests;

use Like\Database\Eloquent;
use Like\Database\Tests\FakerProviders\ProdutoProvider;
use Like\Database\Tests\Models\Produto;
use Like\Database\Tests\Models\ProdutoObserver;
use Like\Database\Tests\Models\Subcategoria;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class EloquentTest extends TestCase {
	public static function set_up_before_class(): void {
		Eloquent::destroy();
		self::assertFalse(Eloquent::isLoaded());

		Eloquent::init(new Config());
	}

	public function testSimpleFactory(): void {
		$subcategoria = Eloquent::factoryOf(Subcategoria::class)->create();
		$this->assertInstanceOf(Subcategoria::class, $subcategoria);

		$produto = Eloquent::factoryOf(Produto::class)->create([
			'codigoSubcategoria' => $subcategoria->codigo,
		]);
		$this->assertInstanceOf(Produto::class, $produto);
		$this->assertEquals($subcategoria->codigo, $produto->subcategoria->codigo);
	}

	public function testMultipleFactoryWithState(): void {
		$subcategorias = Eloquent::factoryOf(Subcategoria::class, 5)->create();
		$this->assertCount(5, $subcategorias);
		foreach ($subcategorias as $subcategoria) {
			$this->assertInstanceOf(Subcategoria::class, $subcategoria);
		}

		$produtos = Eloquent::factoryOf(Produto::class, 5)->states(Produto::REFRIGERANTE)->create([
			'codigoSubcategoria' => $subcategorias[0]->codigo,
		]);
		$this->assertCount(5, $produtos);

		foreach ($produtos as $produto) {
			$this->assertInstanceOf(Produto::class, $produto);
			$this->assertTrue(in_array($produto->nome, ProdutoProvider::REFRIGERANTES));
		}
	}

	public function testDispatchEvent(): void {
		$subcategoria = Eloquent::factoryOf(Subcategoria::class)->create();

		ProdutoObserver::$i = 0;
		Produto::observe(ProdutoObserver::class);

		$this->assertEquals(0, ProdutoObserver::$i);

		Produto::create([
			'referencia' => 1,
			'nome' => 'Coca-cola',
			'codigoSubcategoria' => $subcategoria->codigo,
		]);
		$this->assertEquals(1, ProdutoObserver::$i);

		Eloquent::factoryOf(Produto::class)->create([
			'codigoSubcategoria' => $subcategoria->codigo,
		]);
		$this->assertEquals(2, ProdutoObserver::$i);
	}
}
