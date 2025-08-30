<?php

namespace Like\Database\Tests\Models;

class ProdutoObserver {
	public static $i = 0;

	public function created(Produto $produto): void {
		self::$i++;
	}
}
