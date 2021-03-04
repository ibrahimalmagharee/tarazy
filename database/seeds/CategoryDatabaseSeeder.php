<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'التفصيل',
                'parent_id' => null,
                'is_active' => true,
            ],
            [
                'name' => 'الأقمشة',
                'parent_id' => null,
                'is_active' => true,
            ],
            [
                'name' => 'عباءات',
                'parent_id' => '1',
                'is_active' => true,
            ],
            [
                'name' => "كشمير",
                'parent_id' => '2',
                'is_active' => true,
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
