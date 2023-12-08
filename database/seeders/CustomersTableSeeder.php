<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers')->delete();
        
        \DB::table('customers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Default Customer',
                'email' => 'default@gmail.com',
                'phone' => '00000000000',
                'address' => 'Default Address',
                'receivable' => '0.00',
                'payable' => '0.00',
                'balance' => '0.00',
                'status' => '1',
                'created_at' => '2023-11-22 19:34:22',
                'updated_at' => '2023-12-02 20:14:53',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Lois Landry',
                'email' => 'hunufyr@mailinator.com',
            'phone' => '+1 (947) 716-4154',
                'address' => 'Ad non amet cillum',
                'receivable' => '0.00',
                'payable' => '0.00',
                'balance' => '0.00',
                'status' => '1',
                'created_at' => '2023-12-08 19:11:58',
                'updated_at' => '2023-12-08 19:11:58',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Quintessa Dominguez',
                'email' => 'pydazyz@mailinator.com',
            'phone' => '+1 (928) 246-3262',
                'address' => 'Dolor qui et omnis a',
                'receivable' => '0.00',
                'payable' => '0.00',
                'balance' => '0.00',
                'status' => '1',
                'created_at' => '2023-12-08 19:12:07',
                'updated_at' => '2023-12-08 19:12:07',
            ),
        ));
        
        
    }
}