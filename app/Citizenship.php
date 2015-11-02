<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Citizenship extends Model
{
   use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'ref_citizenship_tbl';
	protected $primaryKey = 'id';

	protected $fillable = ['id', 'citizenship_name', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];
	
}
