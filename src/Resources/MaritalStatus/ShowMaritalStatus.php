<?php

namespace Hanafalah\ModulePeople\Resources\MaritalStatus;

use Hanafalah\ModulePeople\Resources\PeopleStuff\ShowPeopleStuff;

class ShowMaritalStatus extends ViewMaritalStatus
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
    $show = $this->resolveNow(new ShowPeopleStuff($this));
    $arr = $this->mergeArray(parent::toArray($request),$show,$arr);
    return $arr;
  }
}
