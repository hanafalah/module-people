<?php

namespace Hanafalah\ModulePeople\Resources\FamilyRole;

use Hanafalah\ModulePeople\Resources\PeopleStuff\ViewPeopleStuff;

class ViewFamilyRole extends ViewPeopleStuff
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $arr = [];
    $arr = $this->mergeArray(parent::toArray($request),$arr);
    return $arr;
  }
}
