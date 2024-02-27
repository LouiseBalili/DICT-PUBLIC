<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
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
            'property_no' => $this->property_no,
            'category' => [
                'id' => $this->category->id,
                'catname' => $this->category->catname,
            ],
            'subcategory' => [
                'id' => $this->subcategory->id,
                'subcatname' => $this->subcategory->subcatname,
            ],
            'description' => $this->description,
            'serial_no' => $this->serial_no,
            'measurement_unit' => $this->measurement_unit,
            'unit_value' => $this->unit_value,
            'acquisition' => [
                'id' => $this->acquisition->id,
                'name' => $this->acquisition->name,
            ],
            'received_from' => [
                'id' => $this->receivingEmployee->id,
                'name' => $this->receivingEmployee->fname . ' ' . $this->receivingEmployee->lname,
            ],
            'office' => [
                'id' => $this->office->id,
                'office_name' => $this->office->office_name,
            ],
            'assigned_to' => [
                'id' => $this->assignedEmployee->id,
                'name' => $this->assignedEmployee->fname . ' ' . $this->assignedEmployee->lname,
            ],
            'date_acquired' => $this->date_acquired,
            'status' => $this->status,
            'photo' => $this->photo,
            'document' => $this->document,
        ];
    }
}
