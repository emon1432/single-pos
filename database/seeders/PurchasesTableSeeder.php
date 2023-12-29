<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PurchasesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('purchases')->delete();
        
        \DB::table('purchases')->insert(array (
            0 => 
            array (
                'id' => 1,
                'purchase_no' => 'A0000001',
                'purchase_date' => '2023-12-09',
                'supplier_id' => 4,
                'estimated_amount' => '1150.00',
                'order_tax' => '4.00',
                'shipping_charge' => '4.00',
                'others_charge' => '5.00',
                'discount' => '5.00',
                'total_amount' => '1200.00',
                'total_paid' => '1190.00',
                'total_due' => '10.00',
                'note' => 'rsdfsder',
                'file' => NULL,
                'created_by' => 1,
                'status' => 0,
                'created_at' => '2023-12-09 09:29:00',
                'updated_at' => '2023-12-09 09:29:00',
            ),
        ));
        
        
    }
}