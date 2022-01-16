<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $filalble = [
        'addedby',
        'user_id',
        'category_id',
        'name',
        'details',
        'price',
        'image',
        'gallery',
        'active',
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'gallery' => 'array'
    ];


    protected $appends = [
        'time_ago'
    ];

    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function category()
    {
        //return $this->belongsTo(Category::class, 'category_id');
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }


    public function lottery()
    {
        return $this->belongsTo('App\Models\Lottery', 'product_id');
    }

    public function scopeDefaultProduct($query)
    {
        return  $query;
    }

    /* public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id');
    } */
}