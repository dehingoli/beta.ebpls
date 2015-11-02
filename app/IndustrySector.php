<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class IndustrySector extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'ref_industry_tbl';
	protected $primaryKey = 'id';

	protected $fillable = ['id', 'industry_sec_type', 'industry_sec_code', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];
}
