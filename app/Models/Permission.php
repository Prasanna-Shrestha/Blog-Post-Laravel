<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permisiion extends Model
{
    protected $table = "permissions";
    protected $primaryKey = 'id';
    protected $fillable = ["name"];
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
