<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WinnerImage extends Model
{
    use HasFactory;
    protected $fillable = ['lottery_id', 'gallery', 'video'];
    protected $casts = [
        'gallery' => 'array',
    ];
    public function lottery()
    {
        return $this->belongsTo(Lottery::class, 'lottery_id');
    }
}