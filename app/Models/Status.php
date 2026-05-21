<?php

namespace App\Models;

use App\PostStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Stasus extends Model
{
    protected $table = "statuses";
    protected $primaryKey = 'id';
    protected $fillable = [
        "status",
        "statusable_id",
        "statusable_type",
        "changed_by",
        "created_at"
    ];
    protected $casts = [
        "current_status" => PostStatus::class
    ];
    public function statusable()
    {
        return $this->morphTo();
    }
    // public function users(): BelongsTo{
    //     return $this->belongsTo(User::class);
    // }
    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
