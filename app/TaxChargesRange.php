<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TaxChargesRange extends Model
{
     use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'bp_tax_charges_range_tbl';
    protected $primaryKey = 'id';
	
	protected $fillable = ['id', 'bp_tax_charges_req_id', 'lower_limit', 'higher_limit', 'value', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];

}
