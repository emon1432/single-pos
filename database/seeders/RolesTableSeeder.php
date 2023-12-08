<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Admin',
                'slug' => 'admin',
                'status' => 1,
                'permission' => '{"brands":{"index":true,"store":true,"update":true,"destroy":true},"categories":{"index":true,"store":true,"update":true,"destroy":true},"customers":{"index":true,"store":true,"update":true,"destroy":true},"payment-methods":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"products":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"purchase":{"log-list":true,"pay":true,"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true},"roles-permission":{"index":true,"create":true,"store":true,"edit":true,"update":true},"status":{"update":true},"suppliers":{"index":true,"store":true,"update":true,"destroy":true},"units":{"index":true,"store":true,"update":true,"destroy":true},"users":{"index":true,"create":true,"store":true,"show":true,"edit":true,"update":true,"destroy":true}}',
                'created_at' => NULL,
                'updated_at' => '2023-11-22 20:25:57',
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
