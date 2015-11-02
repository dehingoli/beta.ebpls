<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessNature extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'ref_business_nature_tbl';
    protected $primaryKey = 'id';
	
	protected $fillable = ['id', 'business_nature', 'psic_code', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];

}
