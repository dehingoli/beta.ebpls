<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taxcharges extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'ref_taxcharges_tbl';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'taxcharges_name', 'taxcharges_type_id', 'amount', 'is_default' , 'no_of_years', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];

	public function taxchargestype() {
        return $this->belongsTo('App\Taxchargestype','taxcharges_type_id','id');
    }

}
