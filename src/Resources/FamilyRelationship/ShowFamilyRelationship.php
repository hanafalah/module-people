<?php

namespace Hanafalah\ModulePeople\Resources\FamilyRelationship;

use Hanafalah\LaravelSupport\Resources\ApiResource;
use Illuminate\Support\Str;

class ShowFamilyRelationship extends ViewFamilyRelationship
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
            'reference' => $this->relationValidation('reference',function(){
                return $this->reference->toViewApi();
            })
        ];

        $arr = $this->mergeArray(parent::toArray($request),$arr);
        return $arr;
    }
}
