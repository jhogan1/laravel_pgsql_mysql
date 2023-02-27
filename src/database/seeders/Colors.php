<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class Colors extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create(
            [
                'category_id' => '1',
                'color' => 'blue',
                'hex' => '#0000FF'
            ]
        );
        Color::create(
            [
                'category_id' => '1',
                'color' => 'red',
                'hex' => '#FF0000'
            ]
        );
        Color::create(
            [
                'category_id' => '1',
                'color' => 'yellow',
                'hex' => '#FFFF00'
            ]
        );
        Color::create(
            [
                'category_id' => '2',
                'color' => 'orange',
                'hex' => '#FF6600'
            ]
        );
        Color::create(
            [
                'category_id' => '2',
                'color' => 'green',
                'hex' => '#00FF00'
            ]
        );
        Color::create(
            [
                'category_id' => '2',
                'color' => 'purple',
                'hex' => '#6600FF'
            ]
        );
        Color::create(
            [
                'category_id' => '3',
                'color' => 'kelly green',
                'hex' => '#4CBB17'
            ]
        );
    }
}
