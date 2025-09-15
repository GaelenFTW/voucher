<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'Vouchers';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name', 'voucher_code', 'mall_event', 'full_name',
        'customer_id', 'promo_name', 'status', 'valid_till',
        'creation', 'docstatus', 'acquired_by'
    ];
}
