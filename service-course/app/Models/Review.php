<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',

    ];
    protected $fillable = [
        'course_id', 'user_id', 'rating', 'note'
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
}
