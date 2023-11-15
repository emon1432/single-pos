<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
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
                'permission' => '{"roles-permission":{"index":true,"create":true,"store":true,"edit":false,"update":false},"status":{"update":true},"users":{"index":false,"create":false,"store":false,"show":false,"edit":false,"update":false,"destroy":false}}',
                'created_at' => NULL,
                'updated_at' => '2023-11-15 18:40:00',
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
            ),
        ));
    }
}
