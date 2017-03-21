<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        $categories = App\Category::all();
        $faker = \Faker\Factory::create('en-US');

        foreach ($categories as $category) {
            $randomCount = $faker->randomNumber(2);
            for ($i = 0; $i < $randomCount; $i++) {
                DB::table('products')->insert([
                    'category_id' => $category->id,
                    'name' => ucfirst($faker->word),
                    'price' =>$faker->randomFloat(),
                    'description' => $faker->text(100),
                ]);
            }
        }
    }
}
