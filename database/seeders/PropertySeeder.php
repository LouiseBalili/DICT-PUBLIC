<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Property;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i < 20; $i++) {
            // pick a random number between 1 to 10 (total number of categories)
            $categoryId = mt_rand(1, 10);

            // get the category
            $category = Category::find($categoryId);

            // get the subcategories of the category
            $subcategories = Subcategory::where('category_id', $categoryId)->pluck('id', 'code')->toArray();

            // declare subcategory variable
            $subcategory;

            // check subcategory array length
            if(count($subcategories) == 1) {
                $subcategory = $subcategories[0];
            } else {
                // pick a random element from subcategories
                $rndSubcategorId = $subcategories[array_rand($subcategories)];

                $subcategory = Subcategory::find($rndSubcategorId);
            }

            Property::create([
                'property_no' => $category->code . '-' . $subcategory->code . '-' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT),
                'category_id' => $category->id,
                'subcategory_id' => $subcategory->id,
                'description' => fake()->sentence(),
                'serial_no' => fake()->ean8(),
                'measurement_unit' => fake()->randomElement(['kilograms', 'pieces', 'boxes', 'meters']),
                'unit_value' => fake()->numberBetween(500, 1000),
                'acquisition_id' => fake()->randomElement(range(1, 10)),
                'received_from' => fake()->randomElement(range(1, 5)),
                'office_id' => fake()->randomElement(range(1, 30)),
                'assigned_to' => fake()->randomElement(range(1, 5)),
                'date_acquired' => fake()->date(),
                'status' => fake()->randomElement(['Serviceable', 'Unserviceable']),
            ]);
        }
    }
}
