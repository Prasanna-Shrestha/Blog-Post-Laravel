<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserIsActive extends Model
{
    protected $table = 'user_is_active';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'is_active'
    ];
    protected $casts = [
        'is_active' =>'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
