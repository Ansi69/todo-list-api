<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Status extends Model
{
    protected $fillable = [
        'name',
    ];

    public function status(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function get_note_by_status(): BelongsTo
    {
        return $this->belongsTo(note::class);
    }
}
