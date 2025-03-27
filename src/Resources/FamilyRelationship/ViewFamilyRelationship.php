<?php

namespace Hanafalah\ModulePeople\Resources\FamilyRelationship;

use Hanafalah\LaravelSupport\Resources\ApiResource;
use Illuminate\Support\Str;

class ViewFamilyRelationship extends ApiResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'id'             => $this->id,
            'name'           => $this->name, 
            'phone'          => $this->phone, 
            'role'           => $this->role
        ];
        return $arr;
    }
}
