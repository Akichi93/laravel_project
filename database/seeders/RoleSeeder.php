<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleRecords = [
            ['id_role'=>1,'nom_role'=>'SUPERADMIN','statut'=>0,'created_at'=>NULL,'updated_at'=>NULL],
            ['id_role'=>2,'nom_role'=>'ADMIN','statut'=>1,'created_at'=>NULL,'updated_at'=>NULL],
            ['id_role'=>3,'nom_role'=>'COURTIER','statut'=>1,'created_at'=>NULL,'updated_at'=>NULL],
            ['id_role'=>4,'nom_role'=>'RH','statut'=>1,'created_at'=>NULL,'updated_at'=>NULL],
            ['id_role'=>5,'nom_role'=>'COMMERCIAL','statut'=>1,'created_at'=>NULL,'updated_at'=>NULL],
        ];

        Role::insert($roleRecords);
    }
}
