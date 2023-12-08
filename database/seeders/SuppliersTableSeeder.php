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
            1 => 
            array (
                'id' => 2,
                'name' => 'Khairul Islam Emon',
                'email' => 'emon@gmail.com',
                'phone' => '+8801521437220',
                'address' => 'Merul Badda',
                'receivable' => '0.00',
                'payable' => '0.00',
                'balance' => '0.00',
                'status' => '1',
                'created_at' => '2023-12-08 19:07:36',
                'updated_at' => '2023-12-08 19:07:36',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Limon Mahfuz',
                'email' => 'limon@gmail.com',
                'phone' => '+880171000000',
                'address' => 'ave-4,house-141,5th floor, mirpur DOHS',
                'receivable' => '0.00',
                'payable' => '0.00',
                'balance' => '0.00',
                'status' => '1',
                'created_at' => '2023-12-08 19:08:24',
                'updated_at' => '2023-12-08 19:08:35',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Jony martim',
                'email' => 'jony@gmail.com',
                'phone' => '+88018000000',
                'address' => 'zatrabari',
                'receivable' => '0.00',
                'payable' => '0.00',
                'balance' => '0.00',
                'status' => '1',
                'created_at' => '2023-12-08 19:09:05',
                'updated_at' => '2023-12-08 19:09:05',
            ),
        ));
        
        
    }
}