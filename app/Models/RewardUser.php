<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardUser extends Model
{
    use HasFactory;

    protected $table = 'reward_users';

    protected $fillable = [
        'user_id',
        'reward_id',
    ];

    public function reward()
    {
        return $this->belongsTo(Reward::class, 'reward_id');
    }
}
