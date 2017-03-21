<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();
        $limit = 100;

        for ($i = 0; $i < $limit; $i++){
            DB::table('categories')->insert([
                'name' => 'Category-' . $faker->unique()->randomNumber(5),
                'description' => $faker->text(60)
            ]);
        }
    }
}
