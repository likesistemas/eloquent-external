<?php

namespace Like\Database\Tests\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Like\Database\Tests\Models\Subcategoria
 *
 * @property integer $codigo
 * @property string $nome
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Subcategoria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subcategoria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subcategoria query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subcategoria whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subcategoria whereNome($value)
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
