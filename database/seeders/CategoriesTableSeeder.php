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
            1 => 
            array (
                'id' => 2,
                'name' => 'Cloth',
                'created_at' => '2023-12-08 19:01:47',
                'updated_at' => '2023-12-08 19:01:47',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Notebook',
                'created_at' => '2023-12-08 19:01:57',
                'updated_at' => '2023-12-08 19:01:57',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Rice',
                'created_at' => '2023-12-08 19:02:20',
                'updated_at' => '2023-12-08 19:02:20',
            ),
        ));
        
        
    }
}