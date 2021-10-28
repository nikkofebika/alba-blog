<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	\App\Models\Room::truncate();
    	$rooms = [
    		[
    			'name' => 'Ruangan 1',
    			'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    			'image' => '/images/rooms/sample_room.jpg',
    			'approved_by' => 1,
                'color' => '#f00000',
    		],
    		[
    			'name' => 'Ruangan 2',
    			'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    			'image' => '/images/rooms/sample_room.jpg',
    			'approved_by' => 1,
                'color' => '#8fce00',
    		],
    		[
    			'name' => 'Ruangan 3',
    			'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    			'image' => '/images/rooms/sample_room.jpg',
    			'approved_by' => 1,
                'color' => '#2986cc',
    		],
    		[
    			'name' => 'Ruangan 4',
    			'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    			'image' => '/images/rooms/sample_room.jpg',
    			'approved_by' => 1,
                'color' => '#e6f132',
    		],
    		[
    			'name' => 'Ruangan 5',
    			'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    			'image' => '/images/rooms/sample_room.jpg',
    			'approved_by' => 1,
                'color' => '#df73ab',
    		],
    	];
    	foreach ($rooms as $r) {
    		\App\Models\Room::create([
    			'name' => $r['name'],
    			'description' => $r['description'],
    			'image' => $r['image'],
    			'approved_by' => $r['approved_by'],
                'color' => $r['color']
    		]);
    	}
    }
}
