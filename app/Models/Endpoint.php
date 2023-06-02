<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Endpoint extends Model
{
    use HasFactory;

    protected $fillable = ['location', 'frequency', 'next_check'];

    protected $casts = [
        'next_check' => 'datetime',
    ];

    /**
     * Get the full url from an endpoint
     *
     **/
    public function url(): string
    {
        return $this->site->url().$this->location;
    }

    public function uptimePercentage()
    {
        if (! $this->checks->count()) {
            return null;
        }
        // total successful checks / total number of checks * 100
        return number_format(($this->successful_checks_count / $this->checks->count()) * 100, 2);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function checks(): HasMany
    {
        return $this->hasMany(Check::class);
    }

    public function check(): HasOne
    {
        return $this->hasOne(Check::class)->latestOfMany();
    }
}
