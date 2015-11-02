<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TaxChargesFormula extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'bp_tax_charges_varformula_tbl';
    protected $primaryKey = 'id';
	
	protected $fillable = ['id', 'bp_tax_charges_req_id', 'var_name', 'ref_tax_charges_id', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];

	public function taxCharge() {
        return $this->belongsTo('App\Taxcharges','ref_tax_charges_id','id')->withTrashed();
    }

}
