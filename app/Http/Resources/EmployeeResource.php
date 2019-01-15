<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name->first.' '.$this->name->middle.' '.$this->name->last,
            'department' => $this->department->name,
            'staffPositions' => StaffPositionResource::collection($this->staffPositions),
            'totalSalary' => $this->getTotalSalary(),
        ];
    }
}
