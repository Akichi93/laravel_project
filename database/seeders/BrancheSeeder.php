<?php

namespace Database\Seeders;

use App\Models\Branche;
use Illuminate\Database\Seeder;

class BrancheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brancheRecords = [
            ['id_branche' => 1, 'uuidBranche' => 'b7a645e1-82ac-43fc-b20d-e7fed9616cf0', 'nom_branche' => 'AUTOMOBILE', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 2, 'uuidBranche' => '38800031-66e3-4048-b944-1401e3db1e03', 'nom_branche' => 'MOTO', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 3, 'uuidBranche' => '0b9e1657-56c6-4035-83f0-2761b79fa1b8', 'nom_branche' => 'RC DIVERSES', 'id_entreprise' => '1',  'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 4, 'uuidBranche' => '5f67edff-748f-4b22-bc55-3b7dcbfe4370', 'nom_branche' => 'RC EXPLOITATION', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 5, 'uuidBranche' => '19ecde21-8b33-4b8d-8ef2-3314c580f66e', 'nom_branche' => 'RC ENTREPRISE', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 6, 'uuidBranche' => '46a0ff45-b338-45d6-89e6-a838b36df029', 'nom_branche' => 'RC ASSOCIATION SPORTIVE', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 7, 'uuidBranche' => '16770c1c-9ded-4eea-abdd-dcbc935d175a', 'nom_branche' => 'RC PROFESSIONNELLE', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 8, 'uuidBranche' => 'b5675ac5-4bce-4fbe-acd9-d97142af4579', 'nom_branche' => 'TRANSPORT', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 9, 'uuidBranche' => '2b7bea3c-f781-4304-9c3c-0b3ad7413a9a', 'nom_branche' => 'RC PLAISANCE', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 10, 'uuidBranche' => 'db5125ef-14a3-4404-9475-dd55b16c0ad3', 'nom_branche' => 'MULTIRISQUE PLAISANCE', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 11, 'uuidBranche' => '8745630d-b692-44c3-9756-5ba538a82845', 'nom_branche' => 'MARCHANDISES TRANSPORTEES', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 12, 'uuidBranche' => 'e1c7bdd1-2f52-4173-9da8-5f8aa030dfe6', 'nom_branche' => 'CORPS FLUVIAUX', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 13, 'uuidBranche' => '190a6f5e-8302-4e38-a23f-a007192d90e2', 'nom_branche' => 'MALADIE GROUPE', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 14, 'uuidBranche' => '9df67868-fda0-4434-a507-57e468050870', 'nom_branche' => 'MALADIE PARTICULIER', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 15, 'uuidBranche' => '4ed4fbea-8eb4-4a2d-ad9d-b188b790d7b0', 'nom_branche' => 'ASSISTANCE', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 16, 'uuidBranche' => '731a5d93-8a9a-4da6-ad71-bcb12a9f4649', 'nom_branche' => 'TOUS RISQUES SAUF', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 17, 'uuidBranche' => '5adf3905-909a-4ea5-96c0-5fb2f8c8c999', 'nom_branche' => 'GLOBALES DOMMAGES', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 18, 'uuidBranche' => '520c576d-997c-4448-96b5-6cfa623ff056', 'nom_branche' => 'MULTIRISQUE IMMEUBLE', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 19, 'uuidBranche' => '339b5eb2-9d12-4fe1-8347-17718a351540', 'nom_branche' => 'MULTIRISQUE HABITATION', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 20, 'uuidBranche' => '1cc7a4b1-9c24-4e83-916f-685f9e1218ec', 'nom_branche' => 'MULTIRISQUE PROFESSIONELLE', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 21, 'uuidBranche' => '060d809c-ff88-4e1f-8ae0-83b0da243d8a', 'nom_branche' => 'MULTIRISQUE BUREAUX', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 22, 'uuidBranche' => 'f2e58203-2813-45f6-a9ea-16d724723aec', 'nom_branche' => 'TOUS RISQUE CHANTIER', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 23, 'uuidBranche' => '3319c759-c909-48d8-843b-28b77a36462a', 'nom_branche' => 'RC DECENNALE', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 24, 'uuidBranche' => '3f51a7f9-171b-492b-8614-6f65aaa6aa43', 'nom_branche' => 'TOUS RISQUE MATERIELS', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 25, 'uuidBranche' => '5d90b40a-7662-4935-a669-0223311d7cb7', 'nom_branche' => 'ENGINS DE CHANTIERS', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_branche' => 26, 'uuidBranche' => '15c54481-038c-4aea-a617-7c03bc280753', 'nom_branche' => 'BRIS DE MACHINES', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
        ];


        Branche::insert($brancheRecords);
    }
}
