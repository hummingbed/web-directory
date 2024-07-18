<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'website' => $this->websites($this->websites),
        ];
    }

    private function websites($websites)
    {
        return $websites->map(function ($website) {
            return [
                'id'=> $website->id,
                'name'=> $website->title,
                'description'=> $website->description,
                'url'=> $website->url,
            ];
        });
    }
}
