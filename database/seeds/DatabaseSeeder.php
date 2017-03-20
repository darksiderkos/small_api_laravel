<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(ValueSeeder::class);
        $this->call(ManyToManySeeder::class);

    }
}
