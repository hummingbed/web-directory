<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchWebsiteResource extends JsonResource
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
            'url' => $this->url,
            'title' => $this->title,
            'posted_by' => $this->website_user->name,
            'description' => $this->description,
            'categories' => $this->category($this->categories),
        ];
    }

    private function category($categories)
    {
       return $categories->map(function ($item) {
          return [
              'id' => $item->id,
              'name' => $item->name,
           ];
        });
    }
}
