<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('expense_categories')->delete();
        DB::table('expense_categories')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Purchase',
                'slug' => 'purchase',
                'details' => 'This is Product Purchase Expense Category and it is default',
                'is_default' => 1,
                'status' => '1',
                'created_by' => 1,
                'created_at' => '2022-12-19 08:28:34',
                'updated_at' => '2022-12-19 08:28:34',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Purchase Due Payment',
                'slug' => 'purchase-due-payment',
                'details' => 'This is Purchase Due Payment Expense Category and it is default',
                'is_default' => 1,
                'status' => '1',
                'created_by' => 1,
                'created_at' => '2022-12-19 08:28:34',
                'updated_at' => '2022-12-19 08:28:34',
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'Office Rent',
                'slug' => 'office-rent',
                'details' => 'This is Office Rent Expense Category and it is default',
                'is_default' => 1,
                'status' => '1',
                'created_by' => 1,
                'created_at' => '2022-12-19 08:28:34',
                'updated_at' => '2022-12-19 08:28:34',
            ),
            3 =>
            array(
                'id' => 4,
                'name' => 'Internet Bill',
                'slug' => 'internet-bill',
                'details' => 'This is Internet Bill Expense Category and it is default',
                'is_default' => 0,
                'status' => '1',
                'created_by' => 1,
                'created_at' => '2022-12-19 08:28:34',
                'updated_at' => '2022-12-19 08:28:34',
            ),
            4 =>
            array(
                'id' => 5,
                'name' => 'Electricity Bill',
                'slug' => 'electricity-bill',
                'details' => 'This is Electricity Bill Expense Category and it is default',
                'is_default' => 0,
                'status' => '1',
                'created_by' => 1,
                'created_at' => '2022-12-19 08:28:34',
                'updated_at' => '2022-12-19 08:28:34',
            ),
        ));
    }
}
