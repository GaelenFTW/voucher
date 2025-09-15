<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $table = 'winners'; // create this table in SQL Server
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'voucher_code', 'full_name', 'customer_id', 'mall_event', 'promo_name', 'gift_type'
    ];
}
