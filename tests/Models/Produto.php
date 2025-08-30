<?php

namespace Like\Database\Tests\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Like\Database\Tests\Models\Produto
 *
 * @property integer $codigo
 * @property integer $codigoSubcategoria
 * @property string $nome
 * @property integer|null $referencia
 * @property string $valor
 * @property-read Subcategoria $subcategoria
 *
 * @method static Builder|Produto newModelQuery()
 * @method static Builder|Produto newQuery()
 * @method static Builder|Produto query()
 * @method static Builder|Produto whereCodigo($value)
 * @method static Builder|Produto whereCodigoSubcategoria($value)
 * @method static Builder|Produto whereNome($value)
 * @method static Builder|Produto whereReferencia($value)
 * @method static Builder|Produto whereValor($value)
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
