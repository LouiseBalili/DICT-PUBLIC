<?php

namespace App\Models;

use App\Models\Office;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Acquisition;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_no',
        'category_id',
        'subcategory_id',
        'description',
        'serial_no',
        'measurement_unit',
        'unit_value',
        'acquisition_id',
        'received_from',
        'office_id',
        'assigned_to',
        'date_acquired',
        'status',
        'photo',
        'document',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function acquisition()
    {
        return $this->belongsTo(Acquisition::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function receivingEmployee()
    {
        return $this->belongsTo(Employee::class, 'received_from');
    }

    public function assignedEmployee()
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }
}
