<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'body',
        'is_private',
        'user_id',
    ];


    /**
     * Get the ticket that owns the reply
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }


    /**
     * Get the user that owns the reply.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
