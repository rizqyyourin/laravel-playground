<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TutorialResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'order' => $this->order,
            'estimated_time' => $this->estimated_time,
            'package' => new PackageResource($this->whenLoaded('package')),
            'code_examples_count' => $this->whenCounted('codeExamples'),
            'code_examples' => CodeExampleResource::collection($this->whenLoaded('codeExamples')),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
