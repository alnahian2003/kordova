<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Component\HttpFoundation\Response;

class Check extends Model
{
    use HasFactory;

    protected $fillable = [
        'response_code',
        'response_body',
    ];

    public function endpoint(): BelongsTo
    {
        return $this->belongsTo(Endpoint::class);
    }

    public function isSuccessful(): bool
    {
        return $this->response_code >= 200 && $this->response_code < 300;
    }

    public function statusText()
    {
        return Response::$statusTexts[$this->response_code] ?? 'Unknown';
    }
}
