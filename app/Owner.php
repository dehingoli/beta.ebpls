<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Owner extends Model
{
  	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'bp_owner_tbl';
	protected $primaryKey = 'id';

	protected $fillable = ['id', 'fname', 'mname', 'lname', 'legal_entity', 'bday', 'civil_status', 'gender', 'owner_citizenship_id', 'owner_tin_no', 'owner_province_id', 'owner_city_id', 'owner_district_id', 'owner_brgy_id', 'owner_zone_id', 'complete_address', 'mobile', 'tel_no', 'email', 'others', 'updated_at', 'updated_by' , 'deleted_by'];
	public function province() {
        return $this->belongsTo('App\Province','owner_province_id','id')->withTrashed();
    }
	public function lgu() {
        return $this->belongsTo('App\Lgu','owner_city_id','id')->withTrashed();
    }
	public function district() {
        return $this->belongsTo('App\District','owner_district_id','id')->withTrashed();
    }
	public function barangay() {
        return $this->belongsTo('App\Barangay','owner_brgy_id','id')->withTrashed();
    }
	public function zone() {
        return $this->belongsTo('App\Zone','owner_zone_id','id')->withTrashed();
    }
	public function citizenship() {
        return $this->belongsTo('App\Citizenship','owner_citizenship_id','id')->withTrashed();
    }

}

 		  

