<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessRequirement extends Model
{
  	protected $table = 'bp_business_requirement_tbl';
	protected $primaryKey = 'id';
	
	protected $fillable = ['id', 'business_info_id', 'requirement_id'];
	
}
