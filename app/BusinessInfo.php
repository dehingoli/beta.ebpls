<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BusinessInfo extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'bp_business_info_tbl';
	protected $primaryKey = 'id';
	
	protected $fillable = ['id', 'owner_id', 'black_listed', 'black_listed_desc', 'business_name', 'business_scale_id',
	'business_branch', 'payment_mode_id', 'bldg_name', 'bldg_address', 'bldg_province_id', 
	'bldg_lgu_id', 'bldg_district_id', 'bldg_brgy_id', 'bldg_zone_id', 'bldg_contact_no', 'bldg_email',
	'bldg_fax_no', 'date_established', 'start_date', 'occupancy_id', 
	'ownership_type_id', 'no_of_employees_f', 'no_of_employees_m', 'no_delivery_vehicles', 'location_description', 
	'remarks','transaction_type', 'updated_at', 'updated_by' , 'deleted_by'];
	
	
	
	public function province() {
        return $this->belongsTo('App\Province','bldg_province_id','id')->withTrashed();
    }
	public function lgu() {
        return $this->belongsTo('App\Lgu','bldg_lgu_id','id')->withTrashed();
    }
	public function district() {
        return $this->belongsTo('App\District','bldg_district_id','id')->withTrashed();
    }
	public function barangay() {
        return $this->belongsTo('App\Barangay','bldg_brgy_id','id')->withTrashed();
    }
	public function zone() {
        return $this->belongsTo('App\Zone','bldg_zone_id','id')->withTrashed();
    }
	public function ownership_type() {
        return $this->belongsTo('App\OwnershipType','ownership_type_id','id')->withTrashed();
    }
	public function occupancy_type() {
        return $this->belongsTo('App\OccupancyType','occupancy_id','id')->withTrashed();
    }
	public function owner() {
        return $this->belongsTo('App\Owner','owner_id','id')->withTrashed();
    }
	public function payment_mode() {
        return $this->belongsTo('App\PaymentMode','payment_mode_id','id');
    }
	public function business_info_main() {
        return $this->hasOne('App\BusinessInfoMain','business_info_id','id')->with('lgu')->withTrashed();
    }
	
	public function line_of_business() {
        return $this->belongsTo('App\LineOfBusiness','business_info_id','id')->withTrashed();
    }
	public function requirements() {
        return $this->belongsTo('App\BusinessRequirement','business_info_id','id');
    }
	

}
