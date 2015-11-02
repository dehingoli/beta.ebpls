<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{

	protected $table = 'ref_payment_mode_tbl';
	protected $primaryKey = 'id';

	protected $fillable = ['id', 'payment_mode', ];
}
