<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeSourcesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('income_sources')->delete();
        DB::table('income_sources')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Sell',
                'slug' => 'sell',
                'details' => 'This income source is for product sell and it is default',
                'is_default' => 1,
                'status' => '1',
                'created_by' => 1,
                'created_at' => '2022-12-19 06:27:35',
                'updated_at' => '2022-12-19 06:27:35',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Customer Due Pay',
                'slug' => 'customer-due-pay',
                'details' => 'This income source is for customer due pay and it is default',
                'is_default' => 1,
                'status' => '1',
                'created_by' => 1,
                'created_at' => '2022-12-19 06:27:35',
                'updated_at' => '2022-12-19 06:27:35',
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'Installment Pay',
                'slug' => 'installment-pay',
                'details' => 'This income source is for installment pay',
                'is_default' => 1,
                'status' => '1',
                'created_by' => 1,
                'created_at' => '2022-12-19 06:27:35',
                'updated_at' => '2022-12-19 06:27:35',
            ),
        ));
    }
}
