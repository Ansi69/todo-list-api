<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'status_id',
    ];

    /**
     * Для загрузки удалённых Note
     *
     * @param $value
     * @param $field
     * @return Model|null
     */
    public function resolveRouteBinding($value, $field = null): Model|null
    {
        return $this->withTrashed()->where('id', $value)->firstOrFail();
    }

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

