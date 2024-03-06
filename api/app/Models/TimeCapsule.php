<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeCapsule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'message',
        'open_at',
        'is_opened',
        'user_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'open_at' => 'datetime',
        'is_opened' => 'boolean'
    ];

    /**
     * The attributes that should be hidden.
     *
     * @var array<string>
     */
    protected $hidden = [
        'message'
    ];

    /**
     * Get the user that owns the TimeCapsule
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
