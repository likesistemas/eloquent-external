<?php

namespace Like\Database\Tests\Models;

class ProdutoObserver {
	public static $i = 0;

	/**
	 * @param Produto $produto
	 *
	 * @return void
	 */
	public function created(Produto $produto): void {
		self::$i++;
	}
}
