<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TaxChargesRequirements extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'bp_tax_charges_req_tbl';
    protected $primaryKey = 'id';
	
	protected $fillable = ['id', 'transaction_charge_id', 'transaction_type', 'basis', 'indicator', 'mode', 'formula', 'amount', 'minimum_amount', 'unit_measure', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];

	
	public function taxCharge() {
        return $this->belongsTo('App\Taxcharges','transaction_charge_id','id')->withTrashed();
    }
	

	public function TaxChargesFormula() {
        return $this->hasMany('App\TaxChargesFormula','bp_tax_charges_req_id','id')->orderBy('var_name','asc')->withTrashed();
    }
	public function TaxChargesRange() {
        return $this->hasMany('App\TaxChargesRange','bp_tax_charges_req_id','id')->orderBy('lower_limit','asc')->withTrashed();
    }
	protected static function boot() {
        parent::boot();

        static::deleting(function($tax_req) { // before delete() method call this
			$tax_req->TaxChargesFormula()->delete();
			$tax_req->TaxChargesRange()->delete();
             // do the rest of the cleanup...
        });
    }
	
}
