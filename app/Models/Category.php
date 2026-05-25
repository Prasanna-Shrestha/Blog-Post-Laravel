<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $table = "categories";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        "name",
        "slug"
    ];

    public function posts(): BelongsToMany{
        return $this->belongsToMany(Post::class);
    }
}
