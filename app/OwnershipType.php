<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OwnershipType extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'ref_ownership_type_tbl';
	protected $primaryKey = 'id';

	protected $fillable = ['id', 'ownership_type', 'ownership_code', 'tax_excemptions', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];
	public function tax_excempt() {
        return $this->hasMany('App\OwnershipTypeExcemptions','ownership_type_id','id')->withTrashed();
    }
}
