<?php

namespace Database\Seeders;

use App\Models\FavoriteColor;
use Illuminate\Database\Seeder;

class FavoriteColors extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FavoriteColor::create(
            [
                'user_id' => 1,
                'color_id' => 1
            ]
        );
        FavoriteColor::create(
            [
                'user_id' => 2,
                'color_id' => 2
            ]
        );
        FavoriteColor::create(
            [
                'user_id' => 3,
                'color_id' => 3
            ]
        );
        FavoriteColor::create(
            [
                'user_id' => 4,
                'color_id' => 4
            ]
        );
        FavoriteColor::create(
            [
                'user_id' => 5,
                'color_id' => 5
            ]
        );
        FavoriteColor::create(
            [
                'user_id' => 6,
                'color_id' => 6
            ]
        );
        FavoriteColor::create(
            [
                'user_id' => 7,
                'color_id' => 1
            ]
        );
        FavoriteColor::create(
            [
                'user_id' => 8,
                'color_id' => 2
            ]
        );
        FavoriteColor::create(
            [
                'user_id' => 9,
                'color_id' => 3
            ]
        );
        FavoriteColor::create(
            [
                'user_id' => 10,
                'color_id' => 4
            ]
        );
        FavoriteColor::create(
            [
                'user_id' => 11,
                'color_id' => 5
            ]
        );
        FavoriteColor::create(
            [
                'user_id' => 12,
                'color_id' => 6
            ]
        );
        FavoriteColor::create(
            [
                'user_id' => 13,
                'color_id' => 7
            ]
        );
    }
}
