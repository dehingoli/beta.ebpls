<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lgu extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'ref_lgu_tbl';
	protected $primaryKey = 'id';
	
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'lgu_name', 'lgu_code', 'lgu_province_id', 'zip_code' ,  'blgf_code', 'created_at', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];
	
	public function province() {
        return $this->belongsTo('App\Province','lgu_province_id','id')->withTrashed();
    }

}
