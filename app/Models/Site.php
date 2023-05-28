<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Site extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'default', 'domain', 'scheme'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
