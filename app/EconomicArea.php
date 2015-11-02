<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class EconomicArea extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'ref_economic_area_tbl';
	protected $primaryKey = 'id';

	protected $fillable = ['id', 'economic_area_name', 'economic_area_code', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];
}
