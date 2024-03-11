<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Entreprise;
use Illuminate\Database\Seeder;

class EntrepriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entrepriseRecords = [
            ['id_entreprise'=>1,'nom'=>'Admin','email'=>'jp@gmail.com','contact'=>'','adresse'=>'','date_demande'=> Carbon::now()->format('Y-m-d'),'statut'=>'1','created_at'=>NULL,'updated_at'=>NULL],
        ];

        Entreprise::insert($entrepriseRecords);
    }
}
