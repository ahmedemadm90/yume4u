<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{
    use HasFactory;

    protected $filalble = [
        'id',
        'product_id',
        'ticket_price',
        'start_at',
        'end_at',
        'created_at',
        'updated_at',
        'active',
        'winner_id',
    ];

    public function scopeDefaultLottery($query)
    {
        return  $query;
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }
    public function winnerImages()
    {
        return $this->belongsTo(WinnerImage::class, 'gallery');
    }
}