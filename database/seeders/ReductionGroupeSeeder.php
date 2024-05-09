<?php

namespace Database\Seeders;

use App\Models\ReductionGroupe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReductionGroupeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleRecords = [
            ['id_reductions'=>1,'uuidReductionGroupe'=>'SUPERADMIN','statut'=>0,'created_at'=>NULL,'updated_at'=>NULL],
        ];

        ReductionGroupe::insert($roleRecords);
    }
}
