<?php

use Illuminate\Database\Seeder;
use App\Scrivener;

class ScrivenersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

	for ($i = 0; $i < 5; $i++) {
	   Scrivener::create([
	      'user' => $faker->name,
              'job-title' => $faker->sentence(3)
           ]);
    	}
    }
}
