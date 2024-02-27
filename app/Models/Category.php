<?php

namespace App\Models;

use App\Models\Property;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'catname',
        'code'
    ];

    public function subcategories() 
    {
        return $this->hasMany(Subcategory::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
