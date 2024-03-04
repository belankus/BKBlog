<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'last_activity_at', 'is_online'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
