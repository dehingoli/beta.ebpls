<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{

	protected $table = 'ref_permit_type_tbl';
	protected $primaryKey = 'id';

	protected $fillable = ['id', 'permit_type'];
}
