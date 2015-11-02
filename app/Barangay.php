<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barangay extends Model
{
    use SoftDeletes;
	
    protected $dates = ['deleted_at'];
    protected $table = 'ref_brgy_tbl';
	protected $primaryKey = 'id';
	
	protected $fillable = ['id', 'brgy_name', 'brgy_district_id' , 'blgf_code', 'garbage_zone', 'created_at', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];
	
	public function district() {
        return $this->belongsTo('App\District','brgy_district_id','id')->withTrashed();
    }
}