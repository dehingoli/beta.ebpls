<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BusinessApplication extends Model
{
    use SoftDeletes;
	
	protected $dates = ['deleted_at'];
	protected $table = 'bp_application_tbl';
	protected $primaryKey = 'id';
	
	protected $fillable = ['id', 'business_permit_no', 'business_info_id', 'owner_id', 'application_type', 'reference_no', 'application_method', 'application_status', 'access_pin', 'updated_by' , 'deleted_by'];
	
	public function business_info() {
        return $this->belongsTo('App\BusinessInfo','business_info_id','id')->withTrashed();
    }
	public function owner() {
        return $this->belongsTo('App\Owner','owner_id','id')->withTrashed();
    }
	public function last_data() {
        return $this->belongsTo('App\BusinessApplication','id','id')->orderBy('created_at','desc')->withTrashed();
    }

}
