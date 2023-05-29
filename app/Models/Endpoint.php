<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Endpoint extends Model
{
    use HasFactory;

    protected $fillable = ['location', 'frequency', 'next_check'];

    public $dates = ['next_check'];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
