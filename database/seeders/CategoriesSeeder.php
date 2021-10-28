<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::truncate();
        \App\Models\Category::create([
            'title' => 'Company Bulletin',
            'seo_title' => 'company-bulletin',
            'approved_by' => 1,
            'priority' => 1,
        ]);
    	\App\Models\Category::create([
    		'title' => 'Monthly Culture',
    		'seo_title' => 'monthly-culture',
    		'approved_by' => 1,
            'priority' => 2,
    	]);
    	\App\Models\Category::create([
    		'title' => 'Employee Challenge',
    		'seo_title' => 'employee-challenge',
    		'approved_by' => 1,
            'priority' => 3,
    	]);
    	\App\Models\Category::create([
    		'title' => 'Up Comming Company Event',
    		'seo_title' => 'up-comming-company-event',
    		'approved_by' => 1,
            'priority' => 4,
    	]);
    }
}
