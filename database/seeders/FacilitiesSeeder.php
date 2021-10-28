<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	\App\Models\Facility::truncate();
    	\App\Models\Facility::create([
    		'name' => 'Transportasi',
    		'url' => 'https://www.gojek.com/id-id',
    		'image' => '/images/facilities/car.svg',
    		'is_active' => true,
            'priority' => 1,
    	]);
    	\App\Models\Facility::create([
    		'name' => 'Perjalanan Dinas',
    		'url' => 'https://www.tiket.com',
    		'image' => '/images/facilities/airplane.svg',
    		'is_active' => true,
            'priority' => 2,
    	]);
    	\App\Models\Facility::create([
    		'name' => 'Pengiriman Paket',
    		'url' => 'https://anteraja.id',
    		'image' => '/images/facilities/delivery.svg',
    		'is_active' => true,
            'priority' => 3,
    	]);
    	\App\Models\Facility::create([
    		'name' => 'Medical',
    		'url' => 'https://www.halodoc.com',
    		'image' => '/images/facilities/stethoscope.svg',
    		'is_active' => true,
            'priority' => 4,
    	]);
    }
}
