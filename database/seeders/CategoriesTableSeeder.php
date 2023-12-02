<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Default Category',
                'created_at' => '2023-12-02 20:12:22',
                'updated_at' => '2023-12-02 20:12:22',
            ),
        ));
        
        
    }
}