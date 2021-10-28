<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    	\App\Models\Article::truncate();
        $category_id = 1;
        for ($i=1; $i < 100; $i++) { 
          \App\Models\Article::create([
             'article_category_id' => $category_id++,
             'title' => 'Sample Bulletin '.$i,
             'seo_title' => 'sample-bulletin-'.$i,
             'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p><p><span style="white-space:pre">	</span>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p><p><span style="white-space:pre">	</span>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p><p><span style="white-space:pre">	</span>consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</p><p><span style="white-space:pre">	</span>cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p><p><span style="white-space:pre">	</span>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p><p><span style="white-space:pre">	</span>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p><p><span style="white-space:pre">	</span>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p><p><span style="white-space:pre">	</span>consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</p><p><span style="white-space:pre">	</span>cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p><p><span style="white-space:pre">	</span>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p><p><span style="white-space:pre">	</span>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p><p><span style="white-space:pre">	</span>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p><p><span style="white-space:pre">	</span>consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</p><p><span style="white-space:pre">	</span>cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p><p><span style="white-space:pre">	</span>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p><p><span style="white-space:pre">	</span>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p><p><span style="white-space:pre">	</span>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p><p><span style="white-space:pre">	</span>consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</p><p><span style="white-space:pre">	</span>cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p><p><span style="white-space:pre">	</span>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
             'sort_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo',
             'image' => '/images/articles/sample_article.jpg',
             'created_by' => 1,
             'approved_by' => 1,
             'published_at' => date('Y-m-d H:i:s'),
             'created_at' => date('Y-m-d H:i:s'),
         ]);
          if ($category_id > 4) {
            $category_id = 1;
        }
    }
}
}
