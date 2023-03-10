<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory(25)->create();

        $this->call(
            [
                ColorCategories::class,
                Colors::class,
                FavoriteColors::class
            ]
        );
    }
}
