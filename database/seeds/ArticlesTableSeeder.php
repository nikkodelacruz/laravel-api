<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Let's truncate our existing records to start from scratch.
        // Article::truncate();

    	// METHOD 1
        // factory(App\Article::class, 30)->create(); //will call factories

    	// METHOD 2
        // And now, let's create a few articles in our database:
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            Article::create([
                'title' => $faker->sentence,
                'body' => $faker->paragraph,
            ]);
        }

        #add seed data
		// php artisan db:seed

		#seed specific classs
		// php artisan db:seed --class=ArticlesTableSeeder

    }
}
