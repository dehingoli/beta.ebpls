<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Province extends Model
{
	
   use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'ref_province_tbl';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'province_name', 'blgf_code', 'created_at', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];
	
	
	
}
