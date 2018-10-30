<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
	protected $fillable = [
		'title', 'text', 'image', 'date_prod'
	];

	public function authors()
	{
		return $this->belongsToMany(Author::class);
	}
}
