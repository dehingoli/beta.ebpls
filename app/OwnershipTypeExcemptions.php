<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OwnershipTypeExcemptions extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'ref_ownership_type_excemptions_tbl';
	protected $primaryKey = 'id';

	protected $fillable = ['id', 'tax_charges_id', 'ownership_type_id', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];
}
