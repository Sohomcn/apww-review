<?php

namespace App\Models\Review;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    protected $table = 'reviews';

    protected $fillable = [
       'fan_id',
       'model_id',
       'title',
       'body',
       'rating',
       'is_approved',
       'is_active',
       'is_published'
    ];
}
