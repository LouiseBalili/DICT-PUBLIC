<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Property;
use App\Models\Acquisition;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return inertia('Dashboard', [
            'categoriesCount' => Category::count(),
            'subcategoriesCount' => Subcategory::count(),
            'employeesCount' => Employee::count(),
            'acquisitionsCount' => Acquisition::count(),
            'officesCount' => Office::count(),
            'propertiesCount' => Property::count(),
        ]);
    }
}
