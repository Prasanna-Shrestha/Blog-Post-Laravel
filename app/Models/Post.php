<?php

namespace App\Models;

use App\PostStatus;
use App\Models\Comment;
use App\Models\Status;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $table = "posts";

    protected $primaryKey = 'id';

    protected $fillable = [
        "title",
        "slug",
        "body",
        "user_id",
        "current_status"
    ];

    protected $casts = [
        "current_status" => PostStatus::class
    ];

    protected $attributes = [
        'current_status' => PostStatus::draft->value,
    ];

    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }

    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function categories():BelongsToMany {
        return $this->belongsToMany(Category::class);
    }
    public function statuses()
    {
        return $this->morphMany(Status::class, 'statusable');
    }
    
}
