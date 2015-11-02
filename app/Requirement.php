<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Requirement extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'ref_requirements_tbl';
	protected $primaryKey = 'id';

	protected $fillable = ['id', 'requirement', 'id_default', 'permit_id', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];
	
	public function permit() {
        return $this->belongsTo('App\Permit','permit_id','id');
    }
}
