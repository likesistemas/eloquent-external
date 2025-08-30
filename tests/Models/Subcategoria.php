<?php

namespace Like\Database\Tests\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Like\Database\Tests\Models\Subcategoria
 *
 * @property integer $codigo
 * @property string $nome
 *
 * @method static Builder|Subcategoria newModelQuery()
 * @method static Builder|Subcategoria newQuery()
 * @method static Builder|Subcategoria query()
 * @method static Builder|Subcategoria whereCodigo($value)
 * @method static Builder|Subcategoria whereNome($value)
 *
 * @mixin \Eloquent
 */
class Subcategoria extends Model {
	protected $table = 'subcategoria';
	protected $primaryKey = 'codigo';
	public $timestamps = false;

	protected $fillable = [
		'nome',
	];
}
