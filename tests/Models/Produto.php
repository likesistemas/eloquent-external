<?php

namespace Like\Database\Tests\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model {
	protected $table = 'produto';
	protected $primaryKey = 'codigo';
	public $timestamps = false;

	const REFRIGERANTE = 'refrigerante';
	const CERVEJA = 'cerveja';

	protected $fillable = [
		'nome', 'valor', 'codigoSubcategoria',
	];

	public function subcategoria() {
		return $this->belongsTo(Subcategoria::class, 'codigoSubcategoria');
	}
}
