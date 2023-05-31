<?php

namespace App\Http\Requests;

use App\Enums\EndpointFrequencyEnums;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class EndpointStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('storeEndpoint', $this->site);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'location'  => 'required',
            'frequency' => ['required', new Enum(EndpointFrequencyEnums::class)],
        ];
    }
}
