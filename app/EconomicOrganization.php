<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class EconomicOrganization extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'ref_economic_organization_tbl';
	protected $primaryKey = 'id';

	protected $fillable = ['id', 'economic_org_name', 'economic_org_code', 'created_by', 'updated_at', 'updated_by' , 'deleted_by'];
}
