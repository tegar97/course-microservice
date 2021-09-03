<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;
    protected $table = 'payment_logs';

    protected $fillable = [
        'status', 'payment_type', 'order_id', 'raw_response'
    ];

    protected $cast = [
        'created_at' => 'datetime:Y-md H:m:s',
        'updated_at' => 'datetime:Y-md H:m:s',
        'metadata' => 'array'
    ];
}
