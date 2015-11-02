<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class District extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'ref_district_tbl';
	protected $primaryKey = 'id';
	
	protected $fillable = ['id', 'distric_name', 'district_lgu_id', 'blgf_code', 'created_at', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];
	
	public function lgu() {
        return $this->belongsTo('App\Lgu','district_lgu_id','id')->withTrashed();
    }
	
}
