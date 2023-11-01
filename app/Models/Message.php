<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message_content',
        'message_image'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
}