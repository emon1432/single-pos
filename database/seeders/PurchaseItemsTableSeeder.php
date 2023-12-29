<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PurchaseItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('purchase_items')->delete();
        
        \DB::table('purchase_items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'purchase_id' => 1,
                'purchase_no' => 'A0000001',
                'product_id' => 3,
                'product_name' => 'Math Notebook',
                'unit_id' => 6,
                'unit_quantity' => '10.00',
                'subunit_quantity' => '0.00',
                'unit_price' => '5.00',
                'subunit_price' => '0.00',
                'total' => '50.00',
                'created_at' => '2023-12-09 09:29:00',
                'updated_at' => '2023-12-09 09:29:00',
            ),
            1 => 
            array (
                'id' => 2,
                'purchase_id' => 1,
                'purchase_no' => 'A0000001',
                'product_id' => 1,
                'product_name' => 'Summer Hoover',
                'unit_id' => 3,
                'unit_quantity' => '40.00',
                'subunit_quantity' => '30.00',
                'unit_price' => '20.00',
                'subunit_price' => '10.00',
                'total' => '1100.00',
                'created_at' => '2023-12-09 09:29:00',
                'updated_at' => '2023-12-09 09:29:00',
            ),
        ));
        
        
    }
}