<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
	use SoftDeletes;
	
    protected $dates = ['deleted_at'];
    protected $table = 'ref_zone_tbl';
	protected $primaryKey = 'id';
	
	protected $fillable = ['id', 'zone_name', 'zone_brgy_id', 'created_at', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];
	
	public function barangay() {
        return $this->belongsTo('App\Barangay','zone_brgy_id','id')->withTrashed();
    }

}