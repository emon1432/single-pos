<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankAccountsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('bank_accounts')->delete();
        DB::table('bank_accounts')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Default Account	',
                'slug' => 'default_account	',
                'account_number' => '1234567890',
                'bank_name' => 'Default Bank',
                'branch_name' => 'Default Branch',
                'branch_address' => 'Default Address',
                'details' => 'This is a default account for any store',
                'contact_person' => 'Default Person',
                'contact_number' => '1234567890',
                'email' => 'default@default.com',
                'url' => 'http://default.com',
                'total_deposit' => 0.0,
                'total_withdraw' => 0.0,
                'total_transfer_from_others' => 0.0,
                'total_transfer_to_others' => 0.0,
                'created_by' => 1,
                'status' => 1,
                'created_at' => '2023-12-19 18:37:48',
                'updated_at' => '2023-12-19 18:37:48',
            ),
        ));
    }
}
