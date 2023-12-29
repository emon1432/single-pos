<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PurchaseLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('purchase_logs')->delete();
        
        \DB::table('purchase_logs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'purchase_id' => 1,
                'purchase_no' => 'A0000001',
                'type' => 'Purchase',
                'supplier_id' => 4,
                'created_by' => 1,
                'payment_method_id' => 2,
                'payment_reference' => '01638849305',
                'paid_amount' => '1190.00',
                'due_amount' => '10.00',
                'note' => 'rsdfsder',
                'file' => NULL,
                'created_at' => '2023-12-09 09:29:00',
                'updated_at' => '2023-12-09 09:29:00',
            ),
        ));
        
        
    }
}