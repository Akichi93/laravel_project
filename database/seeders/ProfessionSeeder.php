<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $profesionsRecords =
            [
                [
                    "id_profession" => "1",
                    "profession" => "Médecin",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "237fec35-9579-4387-ad0c-5de8c1e02a5a"
                ],
                [
                    "id_profession" => "2",
                    "profession" => "Enseignant",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "936ac7fa-ad55-4df9-8aae-d59aa5ded97c"
                ],
                [
                    "id_profession" => "3",
                    "profession" => "Ingénieur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "c0098d72-6811-444a-80f1-256e0b8c6faa"
                ],
                [
                    "id_profession" => "4",
                    "profession" => "Avocat",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "f0f23a44-636b-454b-8fdb-e5493a81d838"
                ],
                [
                    "id_profession" => "5",
                    "profession" => "Artiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "8803cf8c-4ebe-4386-a480-658d85947e2a"
                ],
                [
                    "id_profession" => "6",
                    "profession" => "Policier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "8ce44586-f75f-4eec-b159-3a696500755b"
                ],
                [
                    "id_profession" => "7",
                    "profession" => "Pompier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "50df7566-3ee5-428e-b2f1-0c7065f09db9"
                ],
                [
                    "id_profession" => "8",
                    "profession" => "Infirmière",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "24cec0eb-390d-474d-a6fc-4fd45cc594f4"
                ],
                [
                    "id_profession" => "9",
                    "profession" => "Agriculteur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ee92869d-d115-4bbf-b025-46920db20b8c"
                ],
                [
                    "id_profession" => "10",
                    "profession" => "Comptable",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "d254bf59-c42b-4671-999e-2b81dbd23657"
                ],
                [
                    "id_profession" => "11",
                    "profession" => "Électricien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "7e9b5a8c-ed76-417b-9567-0e23c2f5d6c4"
                ],
                [
                    "id_profession" => "12",
                    "profession" => "Plombier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "7a85f6e3-7ef6-4b46-8896-1c3646afec34"
                ],
                [
                    "id_profession" => "13",
                    "profession" => "Journaliste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "b748930e-846a-4340-9669-74e4604ee661"
                ],
                [
                    "id_profession" => "14",
                    "profession" => "Designer",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "5152e58d-1306-48e1-8b76-86c918bde31b"
                ],
                [
                    "id_profession" => "15",
                    "profession" => "Chercheur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "dd44aef1-acd8-4be1-b4f5-ea879eddfb2c"
                ],
                [
                    "id_profession" => "16",
                    "profession" => "Chef cuisinier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "221a11c2-8ced-4783-ba8f-a703b36895ec"
                ],
                [
                    "id_profession" => "17",
                    "profession" => "Chauffeur de taxi",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "f6e9165c-56d5-4110-bd6d-91ec89077d8c"
                ],
                [
                    "id_profession" => "18",
                    "profession" => "Entrepreneur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "bb9f2acd-92d8-4d88-9136-73dc0677169f"
                ],
                [
                    "id_profession" => "19",
                    "profession" => "Acteur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "c9e1cbee-bbf8-4829-bfdb-4cb3b293f15d"
                ],
                [
                    "id_profession" => "20",
                    "profession" => "Boulanger",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "3b0721ed-36e2-45a4-aba2-968b406cab64"
                ],
                [
                    "id_profession" => "21",
                    "profession" => "Astronaute",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "b3af0f58-3fa1-43d0-b606-f5a6b3d8032e"
                ],
                [
                    "id_profession" => "22",
                    "profession" => "Architecte",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "8ed58f77-8395-4e73-947b-8614340fcb35"
                ],
                [
                    "id_profession" => "23",
                    "profession" => "Banquier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "a306adc2-9b0e-4306-a4a0-874d05b28ba9"
                ],
                [
                    "id_profession" => "24",
                    "profession" => "Bibliothécaire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "e4d28bc9-3042-44d4-9909-b8ad209cd37c"
                ],
                [
                    "id_profession" => "25",
                    "profession" => "Boucher",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ae2d4009-45b6-43cc-898d-2aa2aeb2afb7"
                ],
                [
                    "id_profession" => "26",
                    "profession" => "Bijoutier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "40f08c0c-502e-4024-9a8f-73abb62cb2d6"
                ],
                [
                    "id_profession" => "27",
                    "profession" => "Chirurgien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "99d768d6-21fd-417d-b0bc-39aaff3aa87a"
                ],
                [
                    "id_profession" => "28",
                    "profession" => "Couvreur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "07c97e06-fd97-4c49-884c-273d1466613f"
                ],
                [
                    "id_profession" => "29",
                    "profession" => "Coiffeur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "aa10f8f4-d9c1-47e9-8e66-99133f00ece4"
                ],
                [
                    "id_profession" => "30",
                    "profession" => "Dentiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "1f1bade5-182e-4c01-acce-8f0710372a71"
                ],
                [
                    "id_profession" => "31",
                    "profession" => "Économiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "879b571c-af77-45ed-a666-56683556275b"
                ],
                [
                    "id_profession" => "32",
                    "profession" => "Facteur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "bb37db86-412d-412e-9f80-40774fe219b2"
                ],
                [
                    "id_profession" => "33",
                    "profession" => "Fermier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "f1e2faf9-ea25-47b3-9796-635c420a68ee"
                ],
                [
                    "id_profession" => "34",
                    "profession" => "Fleuriste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ac2de182-3f67-441e-907d-3a13496ec409"
                ],
                [
                    "id_profession" => "35",
                    "profession" => "Garde forestier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "557fe59f-56da-4223-9f1a-88337a03c912"
                ],
                [
                    "id_profession" => "36",
                    "profession" => "Géologue",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "f6e4f5b3-72f5-4f74-b1e1-7118c4b9eaad"
                ],
                [
                    "id_profession" => "37",
                    "profession" => "Graphiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "169c89ea-6f44-47a3-af3b-2997be17a572"
                ],
                [
                    "id_profession" => "38",
                    "profession" => "Guide touristique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "74a5be71-2fec-4a15-86aa-456200e4b98e"
                ],
                [
                    "id_profession" => "39",
                    "profession" => "Historien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "12188ce2-3a72-4a62-9263-7d9764548db1"
                ],
                [
                    "id_profession" => "40",
                    "profession" => "Horloger",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "07387bb7-0028-49dd-90fb-898010022700"
                ],
                [
                    "id_profession" => "41",
                    "profession" => "Infirmier praticien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "badd8a1a-abfd-47a1-a54d-093fe5bff27c"
                ],
                [
                    "id_profession" => "42",
                    "profession" => "Inspecteur de police",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "abbabe33-5073-4750-96dc-99dab61dda7d"
                ],
                [
                    "id_profession" => "43",
                    "profession" => "Juge",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "00e2d115-c799-4ef2-9d6d-5aff5a798408"
                ],
                [
                    "id_profession" => "44",
                    "profession" => "Kinésithérapeute",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "0a4667ea-752a-4a4d-9a6e-594e58755726"
                ],
                [
                    "id_profession" => "45",
                    "profession" => "Libraire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "cc1d24b3-32c2-4e46-83af-89a3755671f5"
                ],
                [
                    "id_profession" => "46",
                    "profession" => "Mécanicien automobile",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "4174ac34-afc3-42ae-aa5a-c3f5e243ebad"
                ],
                [
                    "id_profession" => "47",
                    "profession" => "Négociant en bourse",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "0a88b3f3-3ac3-4e4b-8fd8-df792e59eb9a"
                ],
                [
                    "id_profession" => "48",
                    "profession" => "Orthophoniste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "911fdfa5-985c-4864-a76f-c29e0c96b76f"
                ],
                [
                    "id_profession" => "49",
                    "profession" => "Pharmacien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "257e3dd5-a33a-4960-9efc-d1a1c262f6a6"
                ],
                [
                    "id_profession" => "50",
                    "profession" => "Pilote de ligne",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "29af3388-a462-4413-b2de-0bfa5713418f"
                ],
                [
                    "id_profession" => "51",
                    "profession" => "Psychologue",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "73ea3496-b0e5-4dd0-954f-5e44911e0a45"
                ],
                [
                    "id_profession" => "52",
                    "profession" => "Radiologiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "53cfc8e7-5a3c-4f56-8e0b-8ea1fda29ce3"
                ],
                [
                    "id_profession" => "53",
                    "profession" => "Sapeur-pompier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "a5468db2-cd2b-42c6-a1f6-872096b87532"
                ],
                [
                    "id_profession" => "54",
                    "profession" => "Scénariste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "e6149701-65b9-4829-b553-7d88d8a6c028"
                ],
                [
                    "id_profession" => "55",
                    "profession" => "Sculpteur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "3530fde3-44a7-46c8-8d25-7b80cf43da02"
                ],
                [
                    "id_profession" => "56",
                    "profession" => "Serrurier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "887aaf72-b205-41b2-a4b0-f20210dc3199"
                ],
                [
                    "id_profession" => "57",
                    "profession" => "Tailleur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "e81361d4-3e80-4a1a-83ce-c61002f222bc"
                ],
                [
                    "id_profession" => "58",
                    "profession" => "Traducteur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "6e95c6d1-8279-4ab4-9ad6-f8095a48c839"
                ],
                [
                    "id_profession" => "59",
                    "profession" => "Urbaniste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "88a9b342-b488-4daa-9a4e-3e1eb40b1e84"
                ],
                [
                    "id_profession" => "60",
                    "profession" => "Vétérinaire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "d6d6eecb-84b6-4ed1-a41a-d2ee1d74bb7b"
                ],
                [
                    "id_profession" => "61",
                    "profession" => "Zoologiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "10bb04fa-7db8-48ac-8792-b8adefd464f8"
                ],
                [
                    "id_profession" => "62",
                    "profession" => "Agent immobilier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "866f75fc-c7e1-4809-8857-6132be156e19"
                ],
                [
                    "id_profession" => "63",
                    "profession" => "Agriculteur biologique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "2102dfde-158c-43c4-adbc-111acc3a8b3e"
                ],
                [
                    "id_profession" => "64",
                    "profession" => "Animateur radio",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "003836a7-c45b-400a-b898-46f2a3e71ebf"
                ],
                [
                    "id_profession" => "65",
                    "profession" => "Antiquaire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "9f5f8a3a-7738-4ce4-ba8b-59c0825285e0"
                ],
                [
                    "id_profession" => "66",
                    "profession" => "Archéologue",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "fb206a41-1e58-45f0-9700-a5008af72828"
                ],
                [
                    "id_profession" => "67",
                    "profession" => "Astronome",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "b350b082-b96f-49f4-b739-bd9346fd0fbe"
                ],
                [
                    "id_profession" => "68",
                    "profession" => "Bijoutier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "21833926-f227-4d07-ac05-814bf69901fd"
                ],
                [
                    "id_profession" => "69",
                    "profession" => "Boulanger-pâtissier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "fb7d45be-d360-494c-9b9c-6cb9ffe89205"
                ],
                [
                    "id_profession" => "70",
                    "profession" => "Bûcheron",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "83505acb-5a49-4ba8-a8a0-1164b1ff2e4b"
                ],
                [
                    "id_profession" => "71",
                    "profession" => "Chanteur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "0bb0877a-14a5-4b31-a0b7-afd2db74a044"
                ],
                [
                    "id_profession" => "72",
                    "profession" => "Chauffeur de bus",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "23e2e439-9130-412c-9337-1ddb62b04a01"
                ],
                [
                    "id_profession" => "73",
                    "profession" => "Chercheur en biologie",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "2dd810dc-0dd9-4ae3-bd49-800a309069e4"
                ],
                [
                    "id_profession" => "74",
                    "profession" => "Chimiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "a3bd116d-bf0d-4b84-a846-4787284efe8c"
                ],
                [
                    "id_profession" => "75",
                    "profession" => "Coach sportif",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "1cf44ef3-275b-4d52-b9a5-3837c7d129de"
                ],
                [
                    "id_profession" => "76",
                    "profession" => "Conducteur de train",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "fc2cd44c-55ae-4884-b665-2c75268d5277"
                ],
                [
                    "id_profession" => "77",
                    "profession" => "Conseiller financier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "81db307c-fa00-4b55-b987-7e2112412bd7"
                ],
                [
                    "id_profession" => "78",
                    "profession" => "Cuisinier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "93d0d1c4-1030-4958-8c50-838355c80a68"
                ],
                [
                    "id_profession" => "79",
                    "profession" => "Déménageur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "4877f4f7-158c-4a7f-b92c-04c283d5142e"
                ],
                [
                    "id_profession" => "80",
                    "profession" => "Ébéniste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "65529e2f-334c-4710-8358-16fff8f5ffc0"
                ],
                [
                    "id_profession" => "81",
                    "profession" => "Économiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "0ed094cf-28af-464c-818d-d8c64685f0cc"
                ],
                [
                    "id_profession" => "82",
                    "profession" => "Électricien automobile",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "fcbcba97-0c1d-482a-a3aa-c471e7dd2903"
                ],
                [
                    "id_profession" => "83",
                    "profession" => "Électricien bâtiment",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "0b0cd617-1a0e-4af5-b567-596ed32ed0bc"
                ],
                [
                    "id_profession" => "84",
                    "profession" => "Électricien industriel",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "cf944a3b-b040-4054-9a5f-766771aef784"
                ],
                [
                    "id_profession" => "85",
                    "profession" => "Fleuriste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ecb46638-c489-4f7d-b5d0-63e4005d98d0"
                ],
                [
                    "id_profession" => "86",
                    "profession" => "Garde-côte",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "2014f0bd-7941-42e1-bbab-585ac88ad819"
                ],
                [
                    "id_profession" => "87",
                    "profession" => "Géomètre",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "cae6b9dd-764c-4084-977e-f8583f4f67a0"
                ],
                [
                    "id_profession" => "88",
                    "profession" => "Géophysicien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ad11a00e-9fc1-4cca-b556-3dcbf4c62f45"
                ],
                [
                    "id_profession" => "89",
                    "profession" => "Guide de montagne",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "c95473c1-8d18-451d-b37f-52970bc9fa38"
                ],
                [
                    "id_profession" => "90",
                    "profession" => "Ingénieur en aéronautique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "db503e3e-550f-4aa9-8245-e3f1af860d85"
                ],
                [
                    "id_profession" => "91",
                    "profession" => "Ingénieur en informatique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "857da300-5fc3-4f70-b34b-5604f0952bc5"
                ],
                [
                    "id_profession" => "92",
                    "profession" => "Jardinier paysagiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "0a81d566-65c0-4113-be21-63a3f811b969"
                ],
                [
                    "id_profession" => "93",
                    "profession" => "Joallier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "9514712a-b769-4128-9953-d5347bc9f500"
                ],
                [
                    "id_profession" => "94",
                    "profession" => "Journaliste sportif",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "4f60ea21-b730-43d6-b838-359d827fa590"
                ],
                [
                    "id_profession" => "95",
                    "profession" => "Libraire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "bd4ec820-9de4-41dc-b0c1-c2ebb6235505"
                ],
                [
                    "id_profession" => "96",
                    "profession" => "Maçon",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "e55a7588-32b0-4cdd-8730-20c954224e75"
                ],
                [
                    "id_profession" => "97",
                    "profession" => "Mécanicien moto",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "3191d3a0-4220-4c8e-b8b4-63da08f897af"
                ],
                [
                    "id_profession" => "98",
                    "profession" => "Météorologue",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "e3ac122b-ffd8-4d6a-8f86-850b36ac61ff"
                ],
                [
                    "id_profession" => "99",
                    "profession" => "Musicien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "193e0a6f-6d36-4327-8397-c459a1d90683"
                ],
                [
                    "id_profession" => "100",
                    "profession" => "Océanographe",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "4e0b08a7-137e-461c-a733-4bc09ada56d0"
                ],
                [
                    "id_profession" => "101",
                    "profession" => "Optométriste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "23b4dadf-9f8e-4a42-9f4e-e9cd0198db4c"
                ],
                [
                    "id_profession" => "102",
                    "profession" => "Orthopédiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "43028783-6a1d-4e5e-826b-8f54f011515a"
                ],
                [
                    "id_profession" => "103",
                    "profession" => "Pâtissier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "07f6626b-f6d9-40ae-8462-046aa6229abc"
                ],
                [
                    "id_profession" => "104",
                    "profession" => "Pharmacien d'officine",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "bbea833c-8b27-452b-b167-65b275396f60"
                ],
                [
                    "id_profession" => "105",
                    "profession" => "Photographe",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "4388d18a-c266-4410-b7ce-b3197468d77b"
                ],
                [
                    "id_profession" => "106",
                    "profession" => "Physicien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "70bc4eed-b2ea-4590-9cb5-aa172006a0e2"
                ],
                [
                    "id_profession" => "107",
                    "profession" => "Pilote de chasse",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "15116f5f-48e2-4010-9870-d8084bf0df30"
                ],
                [
                    "id_profession" => "108",
                    "profession" => "Plâtrier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ebbdbc70-0dd2-4ccf-9dea-12074f06f5b3"
                ],
                [
                    "id_profession" => "109",
                    "profession" => "Plongeur sous-marin",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "f0aa34f4-6a86-4134-a361-9d3c4b68fdc7"
                ],
                [
                    "id_profession" => "110",
                    "profession" => "Podologue",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ac3ccf2a-b376-4477-9b30-17fc10d21934"
                ],
                [
                    "id_profession" => "111",
                    "profession" => "Poissonnier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "93fc80db-9b87-48a4-a962-9421709a022e"
                ],
                [
                    "id_profession" => "112",
                    "profession" => "Policier scientifique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "4085a432-c4fc-42e2-a6fa-e551f46c2b92"
                ],
                [
                    "id_profession" => "113",
                    "profession" => "Professeur d'université",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "6422be2d-b95d-4bfc-a47e-8cf9f2966231"
                ],
                [
                    "id_profession" => "114",
                    "profession" => "Psychiatre",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "54f529a9-f64e-49e2-bb1e-05c08b66ea73"
                ],
                [
                    "id_profession" => "115",
                    "profession" => "Radiologue",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "179418a3-f97e-4404-a0c5-b8ac5fa16da9"
                ],
                [
                    "id_profession" => "116",
                    "profession" => "Réalisateur de film",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "7a911104-6d08-4faa-8ebb-c89691a143d1"
                ],
                [
                    "id_profession" => "117",
                    "profession" => "Sculpteur sur bois",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "a389a75d-4fe7-4b1f-9117-df530f025c6f"
                ],
                [
                    "id_profession" => "118",
                    "profession" => "Skipper",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "f7a2caba-e08d-4d18-933a-6de90c993975"
                ],
                [
                    "id_profession" => "119",
                    "profession" => "Sociologue",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "f362f92e-5ec5-4977-bba9-56dfe9b2a2fa"
                ],
                [
                    "id_profession" => "120",
                    "profession" => "Sommelier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "687b576e-a41c-496a-b204-8af1f811df18"
                ],
                [
                    "id_profession" => "121",
                    "profession" => "Soudeur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "70a2f4a9-2e83-4d52-9874-adbdc1fb1035"
                ],
                [
                    "id_profession" => "122",
                    "profession" => "Styliste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "a20d3a6c-d6d1-4d04-b10b-71f3bb0fcea7"
                ],
                [
                    "id_profession" => "123",
                    "profession" => "Tailleur de pierre",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "11867801-0a86-4ed3-944f-ed2999866a65"
                ],
                [
                    "id_profession" => "124",
                    "profession" => "Taxidermiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "82d6f3e1-7a8a-4055-a48d-9ebb39233b58"
                ],
                [
                    "id_profession" => "125",
                    "profession" => "Tôlier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "afb01f78-ebdb-4619-9afa-b4231a39a180"
                ],
                [
                    "id_profession" => "126",
                    "profession" => "Urbaniste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "4f0ec791-88bc-465e-a7ac-de9a2322cc3e"
                ],
                [
                    "id_profession" => "127",
                    "profession" => "Vendeur de voitures",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "672ba070-55d6-4434-b7a6-7c041b492714"
                ],
                [
                    "id_profession" => "128",
                    "profession" => "Viticulteur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "dd4169d5-c9e0-4f72-a86b-32650aee208a"
                ],
                [
                    "id_profession" => "129",
                    "profession" => "Zoologiste marin",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "a0e576e1-3d47-4678-b8d8-0a65556c16e0"
                ],
                [
                    "id_profession" => "130",
                    "profession" => "Acrobate",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "06b004ea-a0aa-45c1-b8d8-eb1eafe429c2"
                ],
                [
                    "id_profession" => "131",
                    "profession" => "Aide-soignant",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "4a614b80-0d3c-4793-a1c7-55c6d1c8c07c"
                ],
                [
                    "id_profession" => "132",
                    "profession" => "Archiviste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "19a3553e-2e67-4583-acc1-cd8f8da0dae1"
                ],
                [
                    "id_profession" => "133",
                    "profession" => "Astronome amateur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "a8b2bd53-0817-4e54-8881-b227a5aac633"
                ],
                [
                    "id_profession" => "134",
                    "profession" => "Bibliothécaire scolaire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "045ce617-a148-4da6-a5f9-2aa91dbe057a"
                ],
                [
                    "id_profession" => "135",
                    "profession" => "Boucher-charcutier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "f84457c3-1beb-4efb-93f3-231a90875e22"
                ],
                [
                    "id_profession" => "136",
                    "profession" => "Cancérologue",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "da175448-2900-4666-b116-2d7c8233b8b3"
                ],
                [
                    "id_profession" => "137",
                    "profession" => "Charpentier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "7f02abcd-f92b-45e7-bbc6-9d85e346afc5"
                ],
                [
                    "id_profession" => "138",
                    "profession" => "Chef de projet informatique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "666579ba-1b5f-4de1-b132-56d40318bc96"
                ],
                [
                    "id_profession" => "139",
                    "profession" => "Chef de rang",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "e60819cb-2962-4e88-9f78-19e692bfbaea"
                ],
                [
                    "id_profession" => "140",
                    "profession" => "Chef étoilé",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "7f89488e-760b-4fab-b4a2-a36fc02d1bae"
                ],
                [
                    "id_profession" => "141",
                    "profession" => "Chiropraticien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "70b63390-ed3e-4c42-9394-51dbe8744f39"
                ],
                [
                    "id_profession" => "142",
                    "profession" => "Chorégraphe",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ebd95c92-9ac0-408f-8d23-62b159e69dd0"
                ],
                [
                    "id_profession" => "143",
                    "profession" => "Cinéaste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "49c32511-c18f-4ed8-b1e4-c71c436e61bc"
                ],
                [
                    "id_profession" => "144",
                    "profession" => "Comédien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "db2c604e-afe8-41ad-912f-75a6bd6e67b3"
                ],
                [
                    "id_profession" => "145",
                    "profession" => "Consultant en marketing",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "653406a2-7e31-417a-beeb-b22764acbce0"
                ],
                [
                    "id_profession" => "146",
                    "profession" => "Danseur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "0d554e9c-285c-4be5-82c3-8eaefecbda3e"
                ],
                [
                    "id_profession" => "147",
                    "profession" => "Dentiste pédiatrique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "4e53a2ab-39b9-43b7-a3d0-1c05c417afce"
                ],
                [
                    "id_profession" => "148",
                    "profession" => "Designer d'intérieur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "67b1aad9-25d7-4626-9ca2-817dfc7bfd22"
                ],
                [
                    "id_profession" => "149",
                    "profession" => "Éboueur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "8d914283-bfe1-47c4-bb93-476aef48e118"
                ],
                [
                    "id_profession" => "150",
                    "profession" => "Écrivain",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ab67333f-85fc-460b-b80f-e46762aded40"
                ],
                [
                    "id_profession" => "151",
                    "profession" => "Électricien de maintenance",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "14be764f-50b4-42c6-8fe8-5335644ec4b2"
                ],
                [
                    "id_profession" => "152",
                    "profession" => "Électricien naval",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "a5436ace-aca0-437d-b949-396fd0446682"
                ],
                [
                    "id_profession" => "153",
                    "profession" => "Électricien résidentiel",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "57ccc35e-3b0e-4222-9f8b-0604bdda5558"
                ],
                [
                    "id_profession" => "154",
                    "profession" => "Électronicien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "0b83bf47-7f21-4114-a9b4-9a2dff8f45d7"
                ],
                [
                    "id_profession" => "155",
                    "profession" => "Facteur d'instruments de musique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "807b6b52-7095-45dc-ac71-f82151a24a8a"
                ],
                [
                    "id_profession" => "156",
                    "profession" => "Fleuriste en ligne",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "6b08acd6-d803-43ec-a837-bdf8ba6944cf"
                ],
                [
                    "id_profession" => "157",
                    "profession" => "Frigoriste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "86f8e05a-e18d-435b-91b8-809a41d8bb4d"
                ],
                [
                    "id_profession" => "158",
                    "profession" => "Garde-pêche",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "94f265fc-5fda-44cb-ae61-87152322aa06"
                ],
                [
                    "id_profession" => "159",
                    "profession" => "Géophysicien marin",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "c78329af-9932-4ca0-9c76-e71ffd372612"
                ],
                [
                    "id_profession" => "160",
                    "profession" => "Guide de safari",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "0d10e179-ba86-4261-9037-21618f127ed5"
                ],
                [
                    "id_profession" => "161",
                    "profession" => "Hydrogéologue",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "1e5c3809-7f69-4ae5-9e95-617354f9f3c4"
                ],
                [
                    "id_profession" => "162",
                    "profession" => "Ingénieur aérospatial",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "beaf61c4-20fb-44d0-92fc-6ecb9b5b518c"
                ],
                [
                    "id_profession" => "163",
                    "profession" => "Ingénieur civil",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "3b7133f0-9cad-40c7-ad50-a9d6636cef4e"
                ],
                [
                    "id_profession" => "164",
                    "profession" => "Ingénieur du son",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "7b753e12-47e6-481c-8634-c2500fc64bce"
                ],
                [
                    "id_profession" => "165",
                    "profession" => "Joaillier-joaillière",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "edbf4be1-9353-40ba-8cec-3bddc5fcae43"
                ],
                [
                    "id_profession" => "166",
                    "profession" => "Kinésithérapeute pédiatrique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "1816f423-7623-4ffe-bce8-bec2d8dc696c"
                ],
                [
                    "id_profession" => "167",
                    "profession" => "Libraire ancien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "e2e368f5-b1d8-4642-b0a7-df4e587fd383"
                ],
                [
                    "id_profession" => "168",
                    "profession" => "Maître-nageur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "319a3df4-57e1-446f-85da-b55c91e7535c"
                ],
                [
                    "id_profession" => "169",
                    "profession" => "Maquilleur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "5ac06f02-eba2-4c96-ade9-5672563e8a23"
                ],
                [
                    "id_profession" => "170",
                    "profession" => "Maraîcher",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "8a1282ae-1ca2-4320-9b0c-5abe70dc5fd3"
                ],
                [
                    "id_profession" => "171",
                    "profession" => "Médecin légiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "11f53994-852d-4952-a660-39b8dfd88183"
                ],
                [
                    "id_profession" => "172",
                    "profession" => "Météorologiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "b46899b3-40ec-4013-bf44-15ec3f9b2ac2"
                ],
                [
                    "id_profession" => "173",
                    "profession" => "Naturopathe",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "3a5ad86d-f89c-4f23-8abc-190ae6c4edb1"
                ],
                [
                    "id_profession" => "174",
                    "profession" => "Nutritionniste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "77947f3f-6bf0-4d55-9a01-58973a693abf"
                ],
                [
                    "id_profession" => "175",
                    "profession" => "Opérateur de télécommunication",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "6d27b556-8554-485c-9a7e-02114b597d6c"
                ],
                [
                    "id_profession" => "176",
                    "profession" => "Ostéopathe",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "3c8bfed8-1b43-46a8-bd7d-af711e21483b"
                ],
                [
                    "id_profession" => "177",
                    "profession" => "Paysagiste d'intérieur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "19642313-1c48-4e3d-a188-0d9793dee2a3"
                ],
                [
                    "id_profession" => "178",
                    "profession" => "Pharmacien hospitalier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "d37f37ca-5240-4a03-b70c-b259ee4c379e"
                ],
                [
                    "id_profession" => "179",
                    "profession" => "Photographe de mode",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "c5d4d03b-1055-4b8c-a53f-e4690ee54533"
                ],
                [
                    "id_profession" => "180",
                    "profession" => "Physicien nucléaire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "a59170b6-fc3a-499e-9fd7-9a99231906f9"
                ],
                [
                    "id_profession" => "181",
                    "profession" => "Pilote de ligne commercial",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "46644020-bbf7-4a4e-91a4-24ae3773f14f"
                ],
                [
                    "id_profession" => "182",
                    "profession" => "Pilote de sous-marin",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "8babe474-6343-4ab4-9753-108c16636f79"
                ],
                [
                    "id_profession" => "183",
                    "profession" => "Plâtrier-plaquiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ad4a39d3-1150-40ba-a015-8c525b883a43"
                ],
                [
                    "id_profession" => "184",
                    "profession" => "Plongeur professionnel",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "fc16aad3-1ced-4e27-b14f-9de0badb09e3"
                ],
                [
                    "id_profession" => "185",
                    "profession" => "Podologue du sport",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "888d57e7-3e65-42de-a17b-2e6e4997c6bc"
                ],
                [
                    "id_profession" => "186",
                    "profession" => "Poissonnier-traiteur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "714da8e5-fcbd-4893-81af-f060d67c6844"
                ],
                [
                    "id_profession" => "187",
                    "profession" => "Pompier forestier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ff7dc30f-fbfd-4cbc-93dd-ca0fdadf74c4"
                ],
                [
                    "id_profession" => "188",
                    "profession" => "Psychologue du travail",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "64cada1c-4ddf-4cdc-b6ff-b9826e3a5567"
                ],
                [
                    "id_profession" => "189",
                    "profession" => "Radiologue interventionnel",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "d3a0f204-aef7-4a7e-9906-f49ca23d0047"
                ],
                [
                    "id_profession" => "190",
                    "profession" => "Réalisateur de documentaire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "eff05d18-b0f8-47f8-9dd1-42fcf73d1e95"
                ],
                [
                    "id_profession" => "191",
                    "profession" => "Scénariste de jeux vidéo",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "43b11902-3d41-4580-9aeb-5c4afe2b43bf"
                ],
                [
                    "id_profession" => "192",
                    "profession" => "Skipper de course",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "6718ac78-b7d6-4b25-b5e2-ffbfb990f50d"
                ],
                [
                    "id_profession" => "193",
                    "profession" => "Sociologue urbain",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "24eddae4-0dee-4d63-ab17-27000a3fbab8"
                ],
                [
                    "id_profession" => "194",
                    "profession" => "Sommelier de bière",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "44bf5898-6176-4ace-8d53-8ce8a8ec4071"
                ],
                [
                    "id_profession" => "195",
                    "profession" => "Soudeur d'aluminium",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "207f2eb8-1e32-4d44-bf56-5c0ec51e4737"
                ],
                [
                    "id_profession" => "196",
                    "profession" => "Styliste de mode",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "af18e119-b587-408b-a134-8946538660d3"
                ],
                [
                    "id_profession" => "197",
                    "profession" => "Tailleur de pierre tombale",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "cbc61d80-d90d-4f33-b633-5d75b675be65"
                ],
                [
                    "id_profession" => "198",
                    "profession" => "Technicien de laboratoire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "adaac70c-e90a-49ae-922d-2f9300408864"
                ],
                [
                    "id_profession" => "199",
                    "profession" => "Urbaniste paysagiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "682805e2-bf90-4162-bd20-cdd5f4f8334c"
                ],
                [
                    "id_profession" => "200",
                    "profession" => "Vendeur de meubles",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "9de6faeb-4d04-474f-8263-5fa38b7af300"
                ],
                [
                    "id_profession" => "201",
                    "profession" => "Viticulteur bio",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "62b8ae6e-0f47-4659-9197-f8f0ac5057c2"
                ],
                [
                    "id_profession" => "202",
                    "profession" => "Zoologiste marin",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "52d8b3c0-cd17-419f-ba3d-5da8792ff869"
                ],
                [
                    "id_profession" => "203",
                    "profession" => "Aérodynamicien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "3e275c14-4aff-43e5-9c40-7c41f7f311cc"
                ],
                [
                    "id_profession" => "204",
                    "profession" => "Aide-soignant en gériatrie",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "99c5a0a1-4924-4d76-b7a1-df96e7dd1e5c"
                ],
                [
                    "id_profession" => "205",
                    "profession" => "Architecte d'intérieur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "c655e6e1-5c4e-432d-b983-043e63a7d2c4"
                ],
                [
                    "id_profession" => "206",
                    "profession" => "Astronome planétaire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "284d960b-2247-45d2-91af-b0865f36e1c6"
                ],
                [
                    "id_profession" => "207",
                    "profession" => "Bibliothécaire universitaire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "1ff0179f-c04e-413f-b242-4ebabdc434b9"
                ],
                [
                    "id_profession" => "208",
                    "profession" => "Boulanger-pâtissier bio",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "7249f7a6-fa46-4666-a334-b3c6ae058fb1"
                ],
                [
                    "id_profession" => "209",
                    "profession" => "Cancérologue pédiatrique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "a5478ac6-e056-4aa5-bf94-19009a662027"
                ],
                [
                    "id_profession" => "210",
                    "profession" => "Charpentier de marine",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "05323589-58f4-40a9-a583-f657753f1a52"
                ],
                [
                    "id_profession" => "211",
                    "profession" => "Chef de projet web",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "d682379f-fff4-4969-a16b-ba028155ed72"
                ],
                [
                    "id_profession" => "212",
                    "profession" => "Chef glacier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "17260377-afab-4929-98bb-1ac39e68a493"
                ],
                [
                    "id_profession" => "213",
                    "profession" => "Chiropraticien pédiatrique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "83655063-13b1-4313-9a19-5c12de02c80c"
                ],
                [
                    "id_profession" => "214",
                    "profession" => "Chorégraphe de danse contemporaine",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "c359af77-5eb3-4259-b856-13d32c1e5b81"
                ],
                [
                    "id_profession" => "215",
                    "profession" => "Cinéaste indépendant",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "0be2ae5d-dc85-4278-bd39-bc2badfbd295"
                ],
                [
                    "id_profession" => "216",
                    "profession" => "Comédien de doublage",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "aed91b27-0cca-4674-8350-e69f4dd109ab"
                ],
                [
                    "id_profession" => "217",
                    "profession" => "Consultant en ressources humaines",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "49d39b1b-69f2-4e02-be9b-a3911777752a"
                ],
                [
                    "id_profession" => "218",
                    "profession" => "Danseur contemporain",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "3f86ff67-0198-4bc8-ae9b-7b27ca2f164d"
                ],
                [
                    "id_profession" => "219",
                    "profession" => "Dentiste prothésiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "5dc80ecb-f676-4fd8-861f-e25d55179c9d"
                ],
                [
                    "id_profession" => "220",
                    "profession" => "Designer textile",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "7f1f2db5-9f17-4c13-8fba-d882025fba40"
                ],
                [
                    "id_profession" => "221",
                    "profession" => "Éclairagiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ab25f545-2f29-4146-acfe-2f24cab5ca9f"
                ],
                [
                    "id_profession" => "222",
                    "profession" => "Écrivain public",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "291dd72f-a615-4cca-bc5e-b537cad22652"
                ],
                [
                    "id_profession" => "223",
                    "profession" => "Électricien éolien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "2e241f9e-fe0a-4498-9356-0411fde08059"
                ],
                [
                    "id_profession" => "224",
                    "profession" => "Électricien solaire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ed8ce362-f504-4d11-a32e-f43a442f0801"
                ],
                [
                    "id_profession" => "225",
                    "profession" => "Électronicien de marine",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "0211cddc-114b-42f3-a853-87106caf239e"
                ],
                [
                    "id_profession" => "226",
                    "profession" => "Facteur d'orgues",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "708da281-d463-4974-b54d-731d62cc3819"
                ],
                [
                    "id_profession" => "227",
                    "profession" => "Fleuriste en fleurs séchées",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "aafa9b86-9145-48f7-98b1-e91ec96cf8d8"
                ],
                [
                    "id_profession" => "228",
                    "profession" => "Frigoriste industriel",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "88d2a3f4-f4a1-4eda-b7ed-08b46811af8e"
                ],
                [
                    "id_profession" => "229",
                    "profession" => "Garde-rivière",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "1cdc31d1-0498-4b22-a3da-87b9b8d437f6"
                ],
                [
                    "id_profession" => "230",
                    "profession" => "Géotechnicien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "81440f63-86a4-442f-8aa5-4cd514c4dfc7"
                ],
                [
                    "id_profession" => "231",
                    "profession" => "Guide de plongée",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "2b4f272e-7cb3-45e1-a32e-f13301f5bb9a"
                ],
                [
                    "id_profession" => "232",
                    "profession" => "Hydrologue",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "005db006-e7e4-4978-809f-f77364910386"
                ],
                [
                    "id_profession" => "233",
                    "profession" => "Ingénieur agricole",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "89995fdd-8784-4938-96d4-0696dd1240df"
                ],
                [
                    "id_profession" => "234",
                    "profession" => "Ingénieur chimiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "05d430f1-42b4-401c-9513-71ae606c8bac"
                ],
                [
                    "id_profession" => "235",
                    "profession" => "Ingénieur en télécommunications",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "0d4e0117-5947-47b2-9d8c-fd2715b5608c"
                ],
                [
                    "id_profession" => "236",
                    "profession" => "Joaillier-créateur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ffaaf8ac-24e6-4a52-8faf-837ae344ac59"
                ],
                [
                    "id_profession" => "237",
                    "profession" => "Kinésithérapeute sportif",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "945b4918-a37e-48f1-81ed-840e72b37f16"
                ],
                [
                    "id_profession" => "238",
                    "profession" => "Libraire de livres anciens",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "e4522c97-de08-41b1-a4c3-f5032f047e0f"
                ],
                [
                    "id_profession" => "239",
                    "profession" => "Maître de cérémonie",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "d9037477-710e-4779-b55d-6e99d959a8a2"
                ],
                [
                    "id_profession" => "240",
                    "profession" => "Maquilleur de cinéma",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "a4e9610f-c7b0-456a-99bc-8f523a6f6d23"
                ],
                [
                    "id_profession" => "241",
                    "profession" => "Maraudeur social",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "d8f6ff72-23d3-4155-9925-8fc6c1ef1700"
                ],
                [
                    "id_profession" => "242",
                    "profession" => "Médecin humanitaire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "47fb4140-8a9b-4bec-acb9-7bb466368720"
                ],
                [
                    "id_profession" => "243",
                    "profession" => "Météorologiste de l'aviation",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "22336c2e-a204-418c-954b-758742c316c6"
                ],
                [
                    "id_profession" => "244",
                    "profession" => "Naturopathe holistique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "f9019b93-c195-4cf1-a2b6-07a353420960"
                ],
                [
                    "id_profession" => "245",
                    "profession" => "Nutritionniste sportif",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "6396bf5f-6f53-45f8-bf94-ed11c441c53b"
                ],
                [
                    "id_profession" => "246",
                    "profession" => "Ophtalmologiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "c6fdc411-55d5-4d94-849b-16a9d2c0ea06"
                ],
                [
                    "id_profession" => "247",
                    "profession" => "Ostéopathe animalier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "c2b27546-ce5d-435c-b109-13c9e7acb7e4"
                ],
                [
                    "id_profession" => "248",
                    "profession" => "Paysagiste urbain",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "d2fefadc-0b67-4891-aca2-d6003e5e6816"
                ],
                [
                    "id_profession" => "249",
                    "profession" => "Pharmacien industriel",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "013b566c-e937-45bc-9c60-51a4decd3302"
                ],
                [
                    "id_profession" => "250",
                    "profession" => "Photographe de mariage",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "268c7c25-01ba-4d8d-8392-0f0846456ea7"
                ],
                [
                    "id_profession" => "251",
                    "profession" => "Physicien quantique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "89ccae0a-41f8-4e04-91ab-3c275c7c714a"
                ],
                [
                    "id_profession" => "252",
                    "profession" => "Pilote d'hélicoptère",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "a57f2c00-65cc-4129-9cda-e68e81eed35a"
                ],
                [
                    "id_profession" => "253",
                    "profession" => "Plâtrier-stucateur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "b1476962-9b47-4bb3-8624-d917e5ab7a95"
                ],
                [
                    "id_profession" => "254",
                    "profession" => "Plongeur en eaux vives",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "e3b60652-e638-4b93-992a-8aae41ef2000"
                ],
                [
                    "id_profession" => "255",
                    "profession" => "Podologue pédiatrique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "de7e7473-93b4-4ed9-a34d-dd02975e60f1"
                ],
                [
                    "id_profession" => "256",
                    "profession" => "Poissonnier écailler",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "56322e7d-edf9-49d7-807d-91199782dc6d"
                ],
                [
                    "id_profession" => "257",
                    "profession" => "Pompier de secours",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "e84e332e-c5c5-4894-aca5-8cf34abf691b"
                ],
                [
                    "id_profession" => "258",
                    "profession" => "Psychomotricien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "f0d102d7-f1c5-49de-accf-ddf6d88cfbc9"
                ],
                [
                    "id_profession" => "259",
                    "profession" => "Radiologue pédiatrique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ebc62f3c-5df2-448c-b087-ff302d905046"
                ],
                [
                    "id_profession" => "260",
                    "profession" => "Réalisateur de publicités",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "b20db344-02d5-43ea-ad58-0e31ff534ca3"
                ],
                [
                    "id_profession" => "261",
                    "profession" => "Scénariste de bandes dessinées",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "d7835dd2-2d60-471f-a7a0-7b81769c50f4"
                ],
                [
                    "id_profession" => "262",
                    "profession" => "Skipper transatlantique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "584bbb07-6438-4610-934d-238e06e253dc"
                ],
                [
                    "id_profession" => "263",
                    "profession" => "Sociologue de l'environnement",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "e6368a86-1b1e-4ae5-9e08-60871961c088"
                ],
                [
                    "id_profession" => "264",
                    "profession" => "Sommelier de thé",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "b3ea28c1-0ebc-45af-91b9-f7388a43b820"
                ],
                [
                    "id_profession" => "265",
                    "profession" => "Soudeur sous-marin",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ec2a75b0-39cb-4f6d-ae2c-2ef82b566b17"
                ],
                [
                    "id_profession" => "266",
                    "profession" => "Styliste d'intérieur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "90ca6d08-14be-4e0e-8cef-e2fbd42bc99e"
                ],
                [
                    "id_profession" => "267",
                    "profession" => "Tailleur de pierre tombale funéraire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "da85d509-0a97-44e6-883b-b1e58424dfef"
                ],
                [
                    "id_profession" => "268",
                    "profession" => "Technicien de maintenance informatique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "e1436195-fa5a-457c-920e-5cbc903b7763"
                ],
                [
                    "id_profession" => "269",
                    "profession" => "Urbaniste en développement durable",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "bca70a27-1837-4d12-a720-748a1fa4da7e"
                ],
                [
                    "id_profession" => "270",
                    "profession" => "Vendeur de bijoux",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "5bb9d6f6-1855-402f-a591-f2332ee8cb74"
                ],
                [
                    "id_profession" => "271",
                    "profession" => "Viticulteur de vin naturel",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "76b7d833-046e-4252-aa52-7f6686f1997e"
                ],
                [
                    "id_profession" => "272",
                    "profession" => "Zoologiste de la faune sauvage",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "910033ec-3290-4329-a3af-cfbfdce975c1"
                ],
                [
                    "id_profession" => "273",
                    "profession" => "Aéronaute",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "247d34a3-98ed-40c8-b55e-6027671ac4e6"
                ],
                [
                    "id_profession" => "274",
                    "profession" => "Aide-vétérinaire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "602d22f4-89ed-40f8-b655-9ace4bff78bc"
                ],
                [
                    "id_profession" => "275",
                    "profession" => "Architecte naval",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "361cc8de-dab1-4c69-b9da-f19e6a30b56f"
                ],
                [
                    "id_profession" => "276",
                    "profession" => "Astronome professionnel",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "5173af43-fbee-4d78-8b2a-46f15346cde1"
                ],
                [
                    "id_profession" => "277",
                    "profession" => "Bibliothécaire municipal",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "bd428d8f-1719-43a6-b773-4456066d3ea7"
                ],
                [
                    "id_profession" => "278",
                    "profession" => "Boulanger-pâtissier bio",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "888a9ba6-ebc9-4a84-a818-f59256932747"
                ],
                [
                    "id_profession" => "279",
                    "profession" => "Cancérologue radiothérapeute",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "6a05c6c1-28c4-4843-b486-776e5387c45a"
                ],
                [
                    "id_profession" => "280",
                    "profession" => "Charpentier métallique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "e0d80209-6bfd-450d-a164-7230dd1a0f03"
                ],
                [
                    "id_profession" => "281",
                    "profession" => "Chef de projet énergies renouvelables",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "1cd84a5a-3619-4b78-923e-33d862205904"
                ],
                [
                    "id_profession" => "282",
                    "profession" => "Chef pâtissier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ef8edbd2-6176-43ff-982f-f571ea6ac062"
                ],
                [
                    "id_profession" => "283",
                    "profession" => "Chiropraticien sportif",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "0e89d7b7-1cf2-44bf-af60-ca4b31300107"
                ],
                [
                    "id_profession" => "284",
                    "profession" => "Chorégraphe de ballet",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "fbb0db94-a2ff-45ff-b1a5-d07f7ba44d66"
                ],
                [
                    "id_profession" => "285",
                    "profession" => "Cinéaste documentariste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "2a9fe375-f01e-4fcb-ae90-fa839d84a2ed"
                ],
                [
                    "id_profession" => "286",
                    "profession" => "Comédien de théâtre",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "4b61a844-6527-4329-adc7-874163df70e1"
                ],
                [
                    "id_profession" => "287",
                    "profession" => "Consultant en sécurité informatique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "36bb2f41-7c8c-4fee-b1f0-fe533759fb05"
                ],
                [
                    "id_profession" => "288",
                    "profession" => "Danseur hip-hop",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "8c7651c7-78c1-4797-986c-07486ab3b477"
                ],
                [
                    "id_profession" => "289",
                    "profession" => "Dentiste orthodontiste",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "16d4c861-2b9c-42e6-92c4-2902ff7f0bdd"
                ],
                [
                    "id_profession" => "290",
                    "profession" => "Designer de jeux vidéo",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "96bc8669-7e2f-4e0e-8ba1-739517ed4f46"
                ],
                [
                    "id_profession" => "291",
                    "profession" => "Écrivain de science-fiction",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "1ac0b5d7-58c0-44b0-ad2e-2a9ca59a85cf"
                ],
                [
                    "id_profession" => "292",
                    "profession" => "Électricien éolien offshore",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "91097c94-ebe9-42c5-994c-e1a5dc8b7f39"
                ],
                [
                    "id_profession" => "293",
                    "profession" => "Électricien solaire photovoltaïque",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "3fe44212-0340-4b0f-a32b-2e347c8906f9"
                ],
                [
                    "id_profession" => "294",
                    "profession" => "Facteur de clavecins",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "094e5eb0-12ab-4778-aed6-fe2693da39ae"
                ],
                [
                    "id_profession" => "295",
                    "profession" => "Fleuriste en ligne de mariage",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "9a7a106f-f2e8-4dcf-bdb3-f30d8ba7d7f6"
                ],
                [
                    "id_profession" => "296",
                    "profession" => "Frigoriste automobile",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "54ef7817-6c9e-4f80-aac2-6cf58d93f348"
                ],
                [
                    "id_profession" => "297",
                    "profession" => "Garde-frontière",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "67fee91d-1507-4849-9862-f2c1312eb42e"
                ],
                [
                    "id_profession" => "298",
                    "profession" => "Géologue de terrain",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "63334ea1-73a0-4b5b-b56a-b731a3d53f28"
                ],
                [
                    "id_profession" => "299",
                    "profession" => "Guide de safari en Afrique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "d42a65b2-612d-4512-8210-63ae1bb8c1de"
                ],
                [
                    "id_profession" => "300",
                    "profession" => "Hydrologue fluvial",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "097e6d01-c0c6-4594-b540-b42302bcf4b9"
                ],
                [
                    "id_profession" => "301",
                    "profession" => "Ingénieur biomédical",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "d1a9aeac-7104-4185-9e00-0b424b5f0200"
                ],
                [
                    "id_profession" => "302",
                    "profession" => "Ingénieur en énergie nucléaire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "4bac331f-78c2-46f3-80fc-446da1fb9b43"
                ],
                [
                    "id_profession" => "303",
                    "profession" => "Ingénieur en réalité virtuelle",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "f94b3e13-fe25-40a2-b41f-8de1ec0fe1a9"
                ],
                [
                    "id_profession" => "304",
                    "profession" => "Joaillier haute joaillerie",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "8144a643-e6d1-4add-9a90-7022bd8d8978"
                ],
                [
                    "id_profession" => "305",
                    "profession" => "Kinésithérapeute respiratoire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "3fa8053d-bed6-43f6-8116-78f2c1196e2f"
                ],
                [
                    "id_profession" => "306",
                    "profession" => "Libraire spécialisé en BD",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "8f78f57b-ee88-495e-84db-2f8b941d01a1"
                ],
                [
                    "id_profession" => "307",
                    "profession" => "Maître-nageur sauveteur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "103956d2-e1c8-4c17-ba4e-0cf678783fd7"
                ],
                [
                    "id_profession" => "308",
                    "profession" => "Maquilleur de théâtre",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "61242b50-4eb0-483a-b1dd-42ee62f2dc63"
                ],
                [
                    "id_profession" => "309",
                    "profession" => "Marin-pêcheur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "add9aedc-f97e-4970-ad24-c956d6ee7d48"
                ],
                [
                    "id_profession" => "310",
                    "profession" => "Médecin de médecine tropicale",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "9ccef2f5-8b0d-40ec-a271-2e2179206ad3"
                ],
                [
                    "id_profession" => "311",
                    "profession" => "Météorologiste de l'environnement",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "84373337-7f2f-4fd3-b345-916345ce3507"
                ],
                [
                    "id_profession" => "312",
                    "profession" => "Naturopathe en pédiatrie",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "36f5d90b-c31b-4a69-ab48-716b5536d199"
                ],
                [
                    "id_profession" => "313",
                    "profession" => "Nutritionniste en périnatalité",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "7576e200-3d10-4cf0-af1d-dd705dc2a0c3"
                ],
                [
                    "id_profession" => "314",
                    "profession" => "Ophtalmologiste pédiatrique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "742bc896-e625-4246-bae5-1d98f19bee9a"
                ],
                [
                    "id_profession" => "315",
                    "profession" => "Ostéopathe équin",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "9dbfea31-9a61-4435-bc9a-8ef7f91b8175"
                ],
                [
                    "id_profession" => "316",
                    "profession" => "Paysagiste de toit vert",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "3362d2c6-1a21-4a40-9382-7840832903cc"
                ],
                [
                    "id_profession" => "317",
                    "profession" => "Pharmacien hospitalier clinicien",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "8016677b-047c-4737-abc0-79a05d69e145"
                ],
                [
                    "id_profession" => "318",
                    "profession" => "Photographe animalier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "304d9370-6e9b-4e4b-8e39-16f62a1476d3"
                ],
                [
                    "id_profession" => "319",
                    "profession" => "Physicien des particules",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "6d2f3962-8e99-44b7-b41f-ad36589a9eb6"
                ],
                [
                    "id_profession" => "320",
                    "profession" => "Pilote de montgolfière",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "d12c6704-1a42-4d70-ad15-e4439362b278"
                ],
                [
                    "id_profession" => "321",
                    "profession" => "Plâtrier-plaquiste en restauration",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "87f89c47-76fe-4d83-8119-040cfe235ee5"
                ],
                [
                    "id_profession" => "322",
                    "profession" => "Plongeur archéologue",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "fb177496-cc54-4695-8149-cfde6a81c57e"
                ],
                [
                    "id_profession" => "323",
                    "profession" => "Podologue du sport pédiatrique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "d26d62f5-3bb6-4d61-ae72-987064d9f345"
                ],
                [
                    "id_profession" => "324",
                    "profession" => "Poissonnier-traiteur bio",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "85bf610e-7913-49c9-ae41-cb142d88a028"
                ],
                [
                    "id_profession" => "325",
                    "profession" => "Pompier de haute montagne",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "44e8bf7e-8fe2-4d0e-b3bd-9a3960c2add1"
                ],
                [
                    "id_profession" => "326",
                    "profession" => "Psychologue de la santé mentale",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "4d31675f-1e59-4be2-8db2-c392677d5307"
                ],
                [
                    "id_profession" => "327",
                    "profession" => "Radiologue musculo-squelettique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "7270ab5e-7618-4523-b198-9506f4dc0eb9"
                ],
                [
                    "id_profession" => "328",
                    "profession" => "Réalisateur de séries télévisées",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ff9fadb6-b8af-44e7-9407-9ae0ae26955d"
                ],
                [
                    "id_profession" => "329",
                    "profession" => "Scénariste de romans",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "7be269fe-cb0d-486f-95bf-7d1fe6273d36"
                ],
                [
                    "id_profession" => "330",
                    "profession" => "Skipper de voile océanique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "173b407b-094d-49d6-93e6-6c00dd902ee9"
                ],
                [
                    "id_profession" => "331",
                    "profession" => "Sociologue de la mode",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "9a130a4a-52ad-46f3-9e3b-85e973676d8c"
                ],
                [
                    "id_profession" => "332",
                    "profession" => "Sommelier de café",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "fa2c8016-d162-4b63-b2b7-2d2943fd96a7"
                ],
                [
                    "id_profession" => "333",
                    "profession" => "Soudeur de pipelines",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "03745edb-e70d-4a42-bc89-aa4e5c6eb895"
                ],
                [
                    "id_profession" => "334",
                    "profession" => "Styliste de costumes",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "994d822c-78e7-4dff-bbfa-b00b3b560615"
                ],
                [
                    "id_profession" => "335",
                    "profession" => "Tailleur de pierre funéraire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "ef24a708-cf3c-4cbf-974b-99c3751ff5a4"
                ],
                [
                    "id_profession" => "336",
                    "profession" => "Technicien de maintenance éolienne",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "eee799dc-0e4b-4c2a-ac35-fababcecefe6"
                ],
                [
                    "id_profession" => "337",
                    "profession" => "Urbaniste en mobilité urbaine",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "dbc020c2-5a56-46da-8bb7-d1b7711e2cde"
                ],
                [
                    "id_profession" => "338",
                    "profession" => "Vendeur de montres de luxe",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "2affaf8f-6113-4d92-9009-71e448227211"
                ],
                [
                    "id_profession" => "339",
                    "profession" => "Viticulteur en biodynamie",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "c58af314-3b77-4300-b5ce-244b45a5e519"
                ],
                [
                    "id_profession" => "340",
                    "profession" => "Zoologiste de la conservation",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "6d7e2a61-0e0e-43bf-bd4d-65b99ab05d30"
                ],
                [
                    "id_profession" => "341",
                    "profession" => "Agent de voyages",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "a8757e31-d81b-4bb7-868d-1d2d5076069d"
                ],
                [
                    "id_profession" => "342",
                    "profession" => "Aide-soignant en psychiatrie",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "d29c9eac-6866-4248-92c5-a2473464deb6"
                ],
                [
                    "id_profession" => "343",
                    "profession" => "Architecte de paysage",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "f3f749c3-257a-41a8-85a8-0f4318271418"
                ],
                [
                    "id_profession" => "344",
                    "profession" => "Astronome observateur",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "3e387d11-d53e-4aa0-8244-546fce309a6e"
                ],
                [
                    "id_profession" => "345",
                    "profession" => "Bibliothécaire hospitalier",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "2e0694f6-982c-45a9-9858-3680b2c01dba"
                ],
                [
                    "id_profession" => "346",
                    "profession" => "Boulanger-pâtissier vegan",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "d9e28946-5723-47f2-93a0-9e524745700b"
                ],
                [
                    "id_profession" => "347",
                    "profession" => "Cancérologue thoracique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "e73e0ffd-d106-45fc-a610-faa40e53bf12"
                ],
                [
                    "id_profession" => "348",
                    "profession" => "Charpentier traditionnel",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "09762e87-ac1c-4070-a252-e4dfc6ce0172"
                ],
                [
                    "id_profession" => "349",
                    "profession" => "Chef de projet environnemental",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "15e35eec-e992-4af9-b05c-eca9c61dc81c"
                ],
                [
                    "id_profession" => "350",
                    "profession" => "Chef sushi",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "f731dd1a-1b62-4e13-af8f-759ddbeaa381"
                ],
                [
                    "id_profession" => "351",
                    "profession" => "Chiropraticien pédiatrique sportif",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "05c460c6-83c7-4a59-b6ee-99b09129afd0"
                ],
                [
                    "id_profession" => "352",
                    "profession" => "Chorégraphe de danse classique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "3dfea8cc-3dbb-43e7-a481-e3e891fc3f66"
                ],
                [
                    "id_profession" => "353",
                    "profession" => "Cinéaste indépendant documentaire",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "1a188d49-e8c6-432d-9c95-e370064625c4"
                ],
                [
                    "id_profession" => "354",
                    "profession" => "Comédien de stand-up",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "21b378fd-3706-4931-94bf-3ef2e77ed3ae"
                ],
                [
                    "id_profession" => "355",
                    "profession" => "Consultant en développement personnel",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "7d22905c-6421-4c8c-be25-5a9852b97069"
                ],
                [
                    "id_profession" => "356",
                    "profession" => "Danseur de danse contemporaine",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "16f581b3-1b9b-412b-b1e9-3bed7e60fb85"
                ],
                [
                    "id_profession" => "357",
                    "profession" => "Dentiste pédiatrique spécialisé",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "0eecb907-b4da-4667-a26a-7024ec438330"
                ],
                [
                    "id_profession" => "358",
                    "profession" => "Designer de mode éthique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "5ed267e7-aa5d-4467-8cc9-7237e79ab4fd"
                ],
                [
                    "id_profession" => "359",
                    "profession" => "Éducateur canin",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "23f60f8b-2401-4d56-a6eb-2f30b9a052ca"
                ],
                [
                    "id_profession" => "360",
                    "profession" => "Électricien de réseau électrique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "9faa04c0-98aa-41c0-9d00-9a7587c7f105"
                ],
                [
                    "id_profession" => "361",
                    "profession" => "Électricien solaire thermique",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "e947a033-14c3-460b-864a-d734804b8691"
                ],
                [
                    "id_profession" => "362",
                    "profession" => "Facteur de pianos",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "dc62d8ce-d00b-4f07-8ddb-81b8a538cf0b"
                ],
                [
                    "id_profession" => "363",
                    "profession" => "Fleuriste évén",
                    "created_at" => null,
                    "updated_at" => null,
                    "uuidProfession" => "f57299a4-a2d6-4943-81c9-e6b0496d37f8"
                ]
            ];

        Profession::insert($profesionsRecords);
    }
}
