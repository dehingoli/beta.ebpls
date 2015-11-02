<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OccupancyType extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'ref_occupancy_type_tbl';
	protected $primaryKey = 'id';

	protected $fillable = ['id', 'occupancy_type', 'occupancy_code', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];
}
