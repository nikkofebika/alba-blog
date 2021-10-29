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
            'title' => 'Nasional',
            'seo_title' => 'nasional',
            'approved_by' => 1,
            'priority' => 1,
        ]);
    	\App\Models\Category::create([
    		'title' => 'Ekonomi',
    		'seo_title' => 'ekonomi',
    		'approved_by' => 1,
            'priority' => 2,
    	]);
    	\App\Models\Category::create([
    		'title' => 'Olahraga',
    		'seo_title' => 'olahraga',
    		'approved_by' => 1,
            'priority' => 3,
    	]);
    	\App\Models\Category::create([
    		'title' => 'Teknologi',
    		'seo_title' => 'teknologi',
    		'approved_by' => 1,
            'priority' => 4,
    	]);
    }
}
