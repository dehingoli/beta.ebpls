<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LineOfBusiness extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'bp_line_business_tbl';
	protected $primaryKey = 'id';
	
	protected $fillable = ['id', 'business_info_id', 'business_nature_id', 'capital_investment', 'last_year_gross', 'updated_at', 'updated_by' , 'deleted_by'];
	
	public function business_nature() {
        return $this->belongsTo('App\BusinessNature','business_nature_id','id')->withTrashed();
    }
	
}
