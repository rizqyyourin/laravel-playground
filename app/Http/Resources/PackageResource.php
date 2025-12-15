<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'slug' => $this->slug,
            'description' => $this->description,
            'composer_package' => $this->composer_package,
            'documentation_url' => $this->documentation_url,
            'github_url' => $this->github_url,
            'difficulty_level' => $this->difficulty_level,
            'is_official' => $this->is_official,
            'popularity_score' => $this->popularity_score,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'tutorials_count' => $this->whenCounted('tutorials'),
            'tutorials' => TutorialResource::collection($this->whenLoaded('tutorials')),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
