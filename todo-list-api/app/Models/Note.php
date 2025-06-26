<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status_id',
    ];
    public function status(): HasOne
    {
        return $this->hasOne(Status::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}

