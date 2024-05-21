<?php

namespace Database\Seeders;

use App\Models\Activite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActiviteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activiteRecords = [
            ['id_activite' => 1, 'classe' => '1', 'uuidActivite' => 'b7a645e1-82ac-43fc-b20d-e7fed9616cf0', 'activite' => 'Personnes sans profession', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 2, 'classe' => '1', 'uuidActivite' => '38800031-66e3-4048-b944-1401e3db1e03', 'activite' => 'Emploi administratif de bureau', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 3, 'classe' => '1', 'uuidActivite' => '0b9e1657-56c6-4035-83f0-2761b79fa1b8', 'activite' => 'Professions libérales (Notaires ; Avocats ; Huissier de justice )', 'id_entreprise' => '1',  'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 4, 'classe' => '1', 'uuidActivite' => '5f67edff-748f-4b22-bc55-3b7dcbfe4370', 'activite' => 'Enseignants de l\'enseignement non technique ', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 5, 'classe' => '2', 'uuidActivite' => '19ecde21-8b33-4b8d-8ef2-3314c580f66e', 'activite' => 'Répresentant  de commerce', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 6, 'classe' => '2', 'uuidActivite' => '46a0ff45-b338-45d6-89e6-a838b36df029', 'activite' => 'Couturiers', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 7, 'classe' => '2', 'uuidActivite' => '16770c1c-9ded-4eea-abdd-dcbc935d175a', 'activite' => 'Commerçants ( sans travail manuel )', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 8, 'classe' => '2', 'uuidActivite' => 'b5675ac5-4bce-4fbe-acd9-d97142af4579', 'activite' => 'Dépaneurs', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 9, 'classe' => '2', 'uuidActivite' => '2b7bea3c-f781-4304-9c3c-0b3ad7413a9a', 'activite' => 'Marchands ambulants', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 10, 'classe' => '2', 'uuidActivite' => 'db5125ef-14a3-4404-9475-dd55b16c0ad3', 'activite' => 'Agents ou personnel non sédentaire d\'assurance, de banque etc', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 11, 'classe' => '2', 'uuidActivite' => '8745630d-b692-44c3-9756-5ba538a82845', 'activite' => 'Agents de recouvrement', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 12, 'classe' => '2', 'uuidActivite' => 'e1c7bdd1-2f52-4173-9da8-5f8aa030dfe6', 'activite' => 'Coiffeurs', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 13, 'classe' => '2', 'uuidActivite' => '190a6f5e-8302-4e38-a23f-a007192d90e2', 'activite' => 'Acteurs (cinéma , Théatre … )', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 14, 'classe' => '2', 'uuidActivite' => '9df67868-fda0-4434-a507-57e468050870', 'activite' => 'Professions médiales et para-médicales', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 15, 'classe' => '3', 'uuidActivite' => '4ed4fbea-8eb4-4a2d-ad9d-b188b790d7b0', 'activite' => 'Artisans ( emploi de matériels lourds ou encombrants', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 16, 'classe' => '3', 'uuidActivite' => '731a5d93-8a9a-4da6-ad71-bcb12a9f4649', 'activite' => 'Mécaniciens', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 17, 'classe' => '3', 'uuidActivite' => '5adf3905-909a-4ea5-96c0-5fb2f8c8c999', 'activite' => 'Chimiste', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 18, 'classe' => '3', 'uuidActivite' => '520c576d-997c-4448-96b5-6cfa623ff056', 'activite' => 'Boulanger', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 19, 'classe' => '3', 'uuidActivite' => '339b5eb2-9d12-4fe1-8347-17718a351540', 'activite' => 'Patissier', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 20, 'classe' => '3', 'uuidActivite' => '1cc7a4b1-9c24-4e83-916f-685f9e1218ec', 'activite' => 'Imprimeur', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 21, 'classe' => '3', 'uuidActivite' => '060d809c-ff88-4e1f-8ae0-83b0da243d8a', 'activite' => 'Quicailliers', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 22, 'classe' => '3', 'uuidActivite' => 'f2e58203-2813-45f6-a9ea-16d724723aec', 'activite' => 'Sculpteurs', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 23, 'classe' => '3', 'uuidActivite' => '3319c759-c909-48d8-843b-28b77a36462a', 'activite' => 'Enseignants de l\'enseignement technique', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 24, 'classe' => '3', 'uuidActivite' => '3f51a7f9-171b-492b-8614-6f65aaa6aa43', 'activite' => 'Directeurs avec circulation dans les atéliers', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 25, 'classe' => '4', 'uuidActivite' => '5d90b40a-7662-4935-a669-0223311d7cb7', 'activite' => 'Batiments et travaux publics', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 26, 'classe' => '4', 'uuidActivite' => '15c54481-038c-4aea-a617-7c03bc280753', 'activite' => 'Constructions navales', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 27, 'classe' => '4', 'uuidActivite' => '3d2c9cdc-a1ff-4662-867d-95b6bda869a5', 'activite' => 'Industrie ( sauf travail du bois )', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 28, 'classe' => '4', 'uuidActivite' => '8093f386-cb7c-45da-8bfa-44254d8be9af', 'activite' => 'Agriculteurs, épouses des axploitants agricoles et leurs salariés', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 29, 'classe' => '4', 'uuidActivite' => '45ee1a66-0262-4249-8509-de97b8f6a018', 'activite' => 'Déménageurs', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 30, 'classe' => '4', 'uuidActivite' => 'daba7aeb-4c36-45de-8449-b98f812bcd29', 'activite' => 'Professions annexes à l\'agriculture (éléveurs, Vétérinaires … )', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 31, 'classe' => '4', 'uuidActivite' => '6d61d128-2ee1-4d0c-b2c2-1725f7f234f5', 'activite' => 'Conducteurs d\'engins de chantier', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 32, 'classe' => '4', 'uuidActivite' => '6b5b04eb-8e9c-4d11-9e4d-2da7f79661b3', 'activite' => 'Conducteurs d\'engins de levage ', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 33, 'classe' => '4', 'uuidActivite' => 'e23dd777-06fa-4cad-bbe9-8a82faa053c9', 'activite' => 'Conducteurs de Véhicules de transport publics', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 34, 'classe' => '4', 'uuidActivite' => 'ab8918d7-8e73-47c9-b001-177b0544e77b', 'activite' => 'Manutentionnaires', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 35, 'classe' => '4', 'uuidActivite' => '3f0f2a20-d0f3-4f2b-b087-ddcfedf3f20c', 'activite' => 'Livreurs', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 36, 'classe' => '5', 'uuidActivite' => '4772b184-5fba-401b-a7c5-3b398fe818b7', 'activite' => 'Travaux en hauteur y compris échafaudages', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 37, 'classe' => '5', 'uuidActivite' => '42ca94f6-edd4-4767-938e-c1bdbfcc7479', 'activite' => 'Installation et entretien d\'ascenseurs', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 38, 'classe' => '5', 'uuidActivite' => 'e8a89ae7-b925-471d-aef0-285a290666b1', 'activite' => 'Peintures en bâtiment', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 39, 'classe' => '5', 'uuidActivite' => '939000ce-8bc3-4e4d-b188-a3f920cd1fb8', 'activite' => 'Personnes travaillant dans les abattoirs', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 40, 'classe' => '5', 'uuidActivite' => '4d8a9516-a3ad-49ad-82b5-84f3582c3ad9', 'activite' => 'Service de maintien de l\'ordre ( police gendarmerie, garde penitentiaire … )', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 41, 'classe' => '5', 'uuidActivite' => '8124c5d2-e0f3-4952-9506-37de383bab1b', 'activite' => 'Travail manuel en dicks et entrepôts ( dockers )', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 42, 'classe' => '5', 'uuidActivite' => 'cbc03173-94e8-4005-aa5c-7d266116fef9', 'activite' => 'Ouvriers de carrières', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 43, 'classe' => '5', 'uuidActivite' => 'a2c0e4b7-1489-41cc-90f8-9267fa830f07', 'activite' => 'Mise en oeuvre de moyens de secours contre l\'incendie et autres catastrophes', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 44, 'classe' => '6', 'uuidActivite' => '994e3c23-de33-4708-b7dd-8ace1748eefc', 'activite' => 'Travail du bois ( menuiserie ; scierie … )', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 45, 'classe' => '7', 'uuidActivite' => 'd328e52d-60e3-47ba-9bd7-dc896c8669b1', 'activite' => 'Electriciens sur haute tension', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 46, 'classe' => '7', 'uuidActivite' => 'd328e52d-60e3-47ba-9bd7-dc896c8669b1', 'activite' => 'Pêche ou autres travaux en mer', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 47, 'classe' => '7', 'uuidActivite' => '7fdc5656-ba3d-4669-8604-4f206aa84091', 'activite' => 'Travaux souterrains ( extractions; fouilles  … )', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 48, 'classe' => '8', 'uuidActivite' => 'a3aa11d1-3e18-44f1-aa2b-d969466f09c5', 'activite' => 'Abattge d\'arbres', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 49, 'classe' => '8', 'uuidActivite' => '1e6cc700-5aaa-4ab1-8bb2-6fa9be257243', 'activite' => 'Travail sur toits ( couvertures, poseurs d\'antennes … )', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 50, 'classe' => '8', 'uuidActivite' => 'ef451201-4763-40dc-b1d1-16338db0a004', 'activite' => 'Démolitions d\'immeubles', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 51, 'classe' => '8', 'uuidActivite' => '3e7591a6-9095-4702-9271-a923f72867dd', 'activite' => 'Constructions portuaires, d\'ouvrages d\'art, de barrages … )', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 52, 'classe' => '8', 'uuidActivite' => '0e41f889-abcf-450f-b9e1-d469e78912f3', 'activite' => 'Manipulation d\'explosifs', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 53, 'classe' => '8', 'uuidActivite' => 'eb0e106b-9949-45f5-ba5c-98d6c4db4db0', 'activite' => 'Mines', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id_activite' => 54, 'classe' => '8', 'uuidActivite' => 'b08d4606-1e58-439f-a83a-7d31955dff17', 'activite' => 'Ouvriers de sociétés d\'élagage', 'id_entreprise' => '1', 'sync' => '1', 'created_at' => NULL, 'updated_at' => NULL],
           
        ];


        Activite::insert($activiteRecords);
    }
}
