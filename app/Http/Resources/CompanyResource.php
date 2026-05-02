<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'industry' => $this->industry,
            'location' => $this->location,
            'website' => $this->website,
            'status' => $this->is_verified_by_admin ? 'Verified' : 'Not Verified',
            'documentation_file' => asset('storage/' . $this->documentation_file),
        ];
    }
}
