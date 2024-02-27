<?php

namespace App\Models;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory;

    protected $fillable = [
        'office_name',
        'location',
        'classification',
    ];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
