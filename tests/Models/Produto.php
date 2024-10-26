<?php

namespace Like\Database\Tests\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Like\Database\Tests\Models\Produto
 *
 * @property integer $codigo
 * @property integer $codigoSubcategoria
 * @property string $nome
 * @property integer|null $referencia
 * @property string $valor
 * @property-read \Like\Database\Tests\Models\Subcategoria $subcategoria
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Produto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Produto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Produto query()
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereCodigoSubcategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereReferencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereValor($value)
 *
 * @mixin \Eloquent
 */
class Produto extends Model {
	protected $table = 'produto';
	protected $primaryKey = 'codigo';
	public $timestamps = false;

	const REFRIGERANTE = 'refrigerante';
	const CERVEJA = 'cerveja';

	protected $fillable = [
		'nome', 'referencia', 'valor', 'codigoSubcategoria',
	];

	public function subcategoria() {
		return $this->belongsTo(Subcategoria::class, 'codigoSubcategoria');
	}
}
