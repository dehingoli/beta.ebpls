<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxchargestype extends Model
{
   protected $table = 'ref_taxcharges_type_tbl';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'tax_charges_type'];
}
