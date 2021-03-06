<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'status', 'user_id', 'course_id', 'meta_data', 'snap_url'
    ];

    protected $cast = [
        'created_at' => 'datetime:Y-md H:m:s',
        'updated_at' => 'datetime:Y-md H:m:s',
        'meta_data' => 'array'
    ];
}
