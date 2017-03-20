<?php

use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $properties = [
            'Weight'=> 'kg',
            'Speed' => 'rpm',
            'Power'=> 'watts',
            'Patron' => 'mm',
            'Impact force' => 'watts'
        ];
        foreach ($properties as $name=>$value){
            DB::table('properties')->insert([
                'name' => $name,
                'measure' =>$value
            ]);
        }

    }
}
