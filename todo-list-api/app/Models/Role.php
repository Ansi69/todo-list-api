<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function get_user_by_role(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
