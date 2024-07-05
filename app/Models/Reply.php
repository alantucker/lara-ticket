<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    use HasFactory;


    /**
     * Get the ticket that owns the reply
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

}
