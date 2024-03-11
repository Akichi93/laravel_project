<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersRecords = [
            ['id'=>1,'name'=>'Admin','email'=>'jean@gmail.com','contact'=>'0758650487','adresse'=>'Vallon','id_role'=>1,'id_entreprise'=>1,'email_verified_at'=> NULL,'password'=>'$2y$10$Y2niMCQWuigFfFn76gbWx.34lxgasyrNb27sB6yeTYvXVejuRYXN6','remember_token'=>NULL,'created_at'=>NULL,'updated_at'=>NULL],
        ];

        User::insert($usersRecords);
    }
}
