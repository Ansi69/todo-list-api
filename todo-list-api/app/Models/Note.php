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
    public function notes(): HasOne
    {
        return $this->hasOne(Note::class);
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    // получить юзера по посту
    public function get_user_by_post(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

