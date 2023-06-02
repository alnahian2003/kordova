<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'response_code' => $this->response_code,
            'response_body' => $this->response_body,
            'is_successful' => $this->isSuccessful(),
            'status_text' => $this->statusText(),
            'created_at' => DateTimeResource::make($this->created_at),
        ];
    }
}
