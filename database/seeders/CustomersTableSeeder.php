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
                'id' => 2,
                'name' => 'Mahfujur Rahman',
                'email' => 'mahfujurr221@gmail.com',
                'phone' => '01781342259',
                'address' => 'Dhanmondi,Dhaka.',
                'receivable' => '0.00',
                'payable' => '0.00',
                'balance' => '0.00',
                'status' => '1',
                'created_at' => '2023-11-22 19:34:22',
                'updated_at' => '2023-11-22 19:59:45',
            ),
        ));
        
        
    }
}