<?php

namespace App\Http\Resources;

use App\Enums\EndpointFrequencyEnums;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EndpointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'location'          => $this->location,
            'frequency_label'   => EndpointFrequencyEnums::from($this->frequency)->label(),
            'frequency_value'   => EndpointFrequencyEnums::from($this->frequency)->value,
            'latest_check'      => CheckResource::make($this->check),
            'uptime_percentage' => $this->uptimePercentage(),
        ];
    }
}
