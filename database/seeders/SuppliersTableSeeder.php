<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('suppliers')->delete();
        
        \DB::table('suppliers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Default Supplier',
                'email' => 'default@gmail.com',
                'phone' => '000000000000',
                'address' => 'Bonosree,Dhaka.',
                'receivable' => '0.00',
                'payable' => '0.00',
                'balance' => '0.00',
                'status' => '1',
                'created_at' => '2023-11-22 20:29:26',
                'updated_at' => '2023-12-01 16:57:40',
            ),
        ));
        
        
    }
}