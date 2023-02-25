<?php

namespace Database\Seeders;

use App\Models\ColorCategory;
use Illuminate\Database\Seeder;

class ColorCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ColorCategory::create(
            [
                'name' => 'primary'
            ]
        );
        ColorCategory::create(
            [
                'name' => 'secondary'
            ]
        );
    }
}
