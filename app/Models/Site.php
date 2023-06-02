<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'default', 'domain', 'scheme'];

    protected $casts = ['notification_emails' => 'array'];

    public function url()
    {
        return $this->scheme.'://'.$this->domain;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function endpoints(): HasMany
    {
        return $this->hasMany(Endpoint::class)
            ->withCount(['checks as successful_checks_count' => function ($query) {
                $query->where([
                    ['response_code', '>=', 200],
                    ['response_code', '<', 300],
                ]);
            }])
            ->latest();
    }
}
