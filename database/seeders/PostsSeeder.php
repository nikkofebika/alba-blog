<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    	\App\Models\Post::truncate();
    	$titles = ['Post 1', 'Post 2', 'Post 3'];

    	foreach ($titles as $i => $t) {
    		$i++;
    		\App\Models\Post::create([
    			'user_id' => 1,
    			'category_id' => $i,
    			'title' => $t,
    			'seo_title' => Str::slug($t, '-'),
    			'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
    			'image' => '/images/posts/sample.jpg',
    			'approved_by' => 1,
    			'published_at' => date('Y-m-d H:i:s'),
    			'created_at' => date('Y-m-d H:i:s'),
    		]);
    	}
    }
}
