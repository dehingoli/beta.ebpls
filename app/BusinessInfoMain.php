<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BusinessInfoMain extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'bp_business_info_main_tbl';
	protected $primaryKey = 'id';
	
	protected $fillable = ['id','business_info_id', 'dot_acr_no', 'sec_registration', 'bir_reg_no', 'industry_id', 'dti_reg_no',
	'dti_reg_date', 'nso_assigned_no', 'nso_established_id', 'office_name', 'office_lot', 'office_tin_no', 'office_province_id', 'office_lgu_id',
	'office_district_id', 'office_brgy_id', 'office_zone_id', 'office_phone_no', 'economic_org_id', 'business_type_id', 'paid_employees',
	 'economic_area_id', 'subsidiary', 'name','address',
	'updated_at', 'updated_by' , 'deleted_by'];
	
	public function province() {
        return $this->belongsTo('App\Province','office_province_id','id')->withTrashed();
    }
	public function lgu() {
        return $this->belongsTo('App\Lgu','office_lgu_id','id')->withTrashed();
    }
	public function district() {
        return $this->belongsTo('App\District','office_district_id','id')->withTrashed();
    }
	public function barangay() {
        return $this->belongsTo('App\Barangay','office_brgy_id','id')->withTrashed();
    }
	public function zone() {
        return $this->belongsTo('App\Zone','office_zone_id','id')->withTrashed();
    }
	public function economic_area() {
        return $this->belongsTo('App\EconomicArea','economic_area_id','id')->withTrashed();
    }
	public function economic_organization() {
        return $this->belongsTo('App\EconomicOrganization','economic_org_id','id')->withTrashed();
    }

}
