<?php

use Illuminate\Database\Seeder;

class ValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i<100; $i++){
            DB::table('values')->insert([
                'value' => $faker->unique()->randomFloat(),
            ]);
        }
    }
}
