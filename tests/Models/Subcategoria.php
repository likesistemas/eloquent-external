<?php

namespace Like\Database\Tests\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model {
	protected $table = 'subcategoria';
	protected $primaryKey = 'codigo';
	public $timestamps = false;

	protected $fillable = [
		'nome',
	];
}
