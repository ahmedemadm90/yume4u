<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['agent_id', 'user_id', 'points', 'details', 'state'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}