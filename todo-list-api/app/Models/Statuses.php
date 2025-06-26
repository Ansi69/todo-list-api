<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Statuses extends Model
{
    protected $fillable = [
        'name',
    ];

    public function status(): HasMany
    {
        return $this->hasMany(notes::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Notes::class);
    }
}
