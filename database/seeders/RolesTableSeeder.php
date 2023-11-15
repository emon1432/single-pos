<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('roles')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Admin',
                'slug' => 'admin',
                'status' => 1,
                'permission' => '{"accounting":{"balance-sheet":true,"transaction-history":true,"deposit-create":true,"deposit-store":true,"withdraw-create":true,"withdraw-store":true,"bank-transfer-list":true,"bank-transfer-create":true,"bank-transfer-store":true,"income-month-wise":true,"expense-month-wise":true},"bank-accounts":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"brands":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"categories":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"customers":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"expense-categories":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"income-sources":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"installment":{"list":true,"payment":true,"payment-list":true,"payment-due-today":true,"payment-due-all":true,"payment-due-expired":true,"overview":true},"payment-methods":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"products":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"purchase":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"quotations":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true,"approve":true,"reject":true},"roles-permission":{"index":true,"store":true},"sell":{"list":true,"details":true,"due-pay":true,"log-list":true},"stock-transfer":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true,"transfer-list":true,"receive-list":true,"accept":true,"reject":true},"stores":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"subcategories":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"suppliers":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"taxrates":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"units":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"users":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true}}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Customer',
                'slug' => 'customer',
                'status' => 1,
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            )
        ));
    }
}
