<?php

use Illuminate\Database\Seeder;

class ManyToManySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products = App\Product::all();
        $values_count = App\Value::all()->count();
        $properties = App\Property::all();

        foreach ($products as $product) {
            foreach ($properties as $property) {
                DB::table('products_properties_values')->insert([
                    'product_id' => $product->id,
                    'property_id' => $property->id,
                    'value_id' => random_int(1, $values_count)

                ]);
            }
        }


    }
}
