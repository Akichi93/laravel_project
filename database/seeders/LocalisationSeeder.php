<?php

namespace Database\Seeders;

use App\Models\Localisation;
use Illuminate\Database\Seeder;

class LocalisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $VilleRecords = [
            [
                "id_localisation" =>  "1",
                "nom_ville" =>  "Abidjan",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "269fbab7-fdf7-4c1f-8b1e-8741f5fd31dd"
            ],
            [
                "id_localisation" =>  "2",
                "nom_ville" =>  "Yamoussoukro",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "d86ae552-41f2-4647-822d-ae19bac660d9"
            ],
            [
                "id_localisation" =>  "3",
                "nom_ville" =>  "Bouaké",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "b503c2a8-f895-4728-9825-fb40808e27a1"
            ],
            [
                "id_localisation" =>  "4",
                "nom_ville" =>  "Daloa",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "f203c1b4-e3c7-4cef-a57b-6673d4408121"
            ],
            [
                "id_localisation" =>  "5",
                "nom_ville" =>  "Korhogo",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "659b4583-bc26-43a0-9ec8-1666f0ee2172"
            ],
            [
                "id_localisation" =>  "6",
                "nom_ville" =>  "San Pedro",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "5cec81c4-e184-4d9f-bf6a-9bdd604227c7"
            ],
            [
                "id_localisation" =>  "7",
                "nom_ville" =>  "Man",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "acc8446e-b216-47d2-866d-69f972afe995"
            ],
            [
                "id_localisation" =>  "8",
                "nom_ville" =>  "Abengourou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "cd88f24d-e51d-48c2-b829-ccb30d964820"
            ],
            [
                "id_localisation" =>  "9",
                "nom_ville" =>  "Divo",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "c867e805-6165-4179-bda1-6147f18c22b5"
            ],
            [
                "id_localisation" =>  "10",
                "nom_ville" =>  "Gagnoa",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "d678fbd7-fe9a-4a22-a790-bdd5cb3f3328"
            ],
            [
                "id_localisation" =>  "11",
                "nom_ville" =>  "Bondoukou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "7ec90f8b-664e-4fbf-982e-2f46730e3172"
            ],
            [
                "id_localisation" =>  "12",
                "nom_ville" =>  "S\u00e9gu\u00e9la",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "8c4b79c4-6edc-4818-b784-4ec11d316dbe"
            ],
            [
                "id_localisation" =>  "13",
                "nom_ville" =>  "Odienné",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "e8aec58e-3790-4f13-8428-b2248860635c"
            ],
            [
                "id_localisation" =>  "14",
                "nom_ville" =>  "Dimbokro",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "93010bd7-04b1-4ccc-8534-106a28f90af6"
            ],
            [
                "id_localisation" =>  "15",
                "nom_ville" =>  "Ferkessédougou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "9f314cd3-35b7-4bb1-8304-1fcbddbe72be"
            ],
            [
                "id_localisation" =>  "16",
                "nom_ville" =>  "Agboville",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "87000454-2647-42ce-abb9-0ab0f712d2c7"
            ],
            [
                "id_localisation" =>  "17",
                "nom_ville" =>  "Bingerville",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "615e808a-6097-41fb-8fee-d842edb24198"
            ],
            [
                "id_localisation" =>  "18",
                "nom_ville" =>  "Sinfra",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "1adb4e22-2ec2-4647-96e9-9aa88b7c3f6a"
            ],
            [
                "id_localisation" =>  "19",
                "nom_ville" =>  "Soubr\u00e9",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "8564029f-c1b6-4331-9cc3-8aff98a09802"
            ],
            [
                "id_localisation" =>  "20",
                "nom_ville" =>  "Katiola",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "bdd73843-3e61-44db-972d-2ac449bc6e63"
            ],
            [
                "id_localisation" =>  "21",
                "nom_ville" =>  "Bouafl\u00e9",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "ddf0b615-8463-4cc9-b9be-f376644fed22"
            ],
            [
                "id_localisation" =>  "22",
                "nom_ville" =>  "Sakassou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "66e43f43-f1b5-4d54-91ad-378c7bf23b4c"
            ],
            [
                "id_localisation" =>  "23",
                "nom_ville" =>  "Grand-Bassam",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "774fba5e-e5a3-47c4-8456-6248c159ab03"
            ],
            [
                "id_localisation" =>  "24",
                "nom_ville" =>  "Sassandra",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "cb30eec0-799c-4f81-aa43-37ce503d1c6c"
            ],
            [
                "id_localisation" =>  "25",
                "nom_ville" =>  "Dabou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "673b6652-cf0e-4972-8516-0b6f7fad3aea"
            ],
            [
                "id_localisation" =>  "26",
                "nom_ville" =>  "Toumodi",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "1291dd58-5f91-4268-b2e2-f36b76ec2e4b"
            ],
            [
                "id_localisation" =>  "27",
                "nom_ville" =>  "Bouna",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "2061278d-c99e-4f0d-9210-a5e759adec5c"
            ],
            [
                "id_localisation" =>  "28",
                "nom_ville" =>  "Agnibil\u00e9krou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "e3bbd283-f398-484d-9d19-ba2a4be22c9a"
            ],
            [
                "id_localisation" =>  "29",
                "nom_ville" =>  "Guiglo",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "9ea21038-2087-451a-bf97-4a4a3d5037c7"
            ],
            [
                "id_localisation" =>  "30",
                "nom_ville" =>  "Danan\u00e9",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "d142c77c-55d2-43d5-98d4-e1457b41a557"
            ],
            [
                "id_localisation" =>  "31",
                "nom_ville" =>  "Soubre",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "249b0244-09b1-4e06-a94a-6ac95fbd1053"
            ],
            [
                "id_localisation" =>  "32",
                "nom_ville" =>  "Tabou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "e3d3775c-e47d-4bef-8e1e-05e8c31c870b"
            ],
            [
                "id_localisation" =>  "33",
                "nom_ville" =>  "Touba",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "394e6f25-15ed-4ecb-a965-db8fa10d0898"
            ],
            [
                "id_localisation" =>  "34",
                "nom_ville" =>  "Zuénoula",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "b8482aef-f6ad-4779-983f-9d04e9c75043"
            ],
            [
                "id_localisation" =>  "35",
                "nom_ville" =>  "Adzopé",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "aaa53c7c-bcfa-498d-8a75-64aaf80072a3"
            ],
            [
                "id_localisation" =>  "36",
                "nom_ville" =>  "Aboisso",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "691f45b3-5dc8-42ba-97d1-8e0819772522"
            ],
            [
                "id_localisation" =>  "37",
                "nom_ville" =>  "Tiassalé",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "d8026e0f-54e5-465e-b2e1-1c38df51eff1"
            ],
            [
                "id_localisation" =>  "38",
                "nom_ville" =>  "Bongouanou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "19ab1ad9-7d9f-4005-880a-eb700e54f233"
            ],
            [
                "id_localisation" =>  "39",
                "nom_ville" =>  "Akoupé",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "2a1399e9-33f5-4909-a8e0-704f5ae719ff"
            ],
            [
                "id_localisation" =>  "41",
                "nom_ville" =>  "Boundiali",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "2acad9c9-fdd8-4207-87e5-5b78f75550b6"
            ],
            [
                "id_localisation" =>  "42",
                "nom_ville" =>  "Ferkéssédougou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "5d601b0c-b66b-4415-9aa0-42bb82519c1e"
            ],
            [
                "id_localisation" =>  "44",
                "nom_ville" =>  "Koun-Fao",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "dbaba413-47cd-43cc-a1c2-b036a539db55"
            ],
            [
                "id_localisation" =>  "45",
                "nom_ville" =>  "Niakaramandougou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "a821939a-4ed4-494d-8660-0b31fd47ffd6"
            ],
            [
                "id_localisation" =>  "47",
                "nom_ville" =>  "Mankono",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "3b3f3461-abbf-41c6-9493-358da9fbda84"
            ],
            [
                "id_localisation" =>  "48",
                "nom_ville" =>  "Séguéla",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "acc7ca35-de02-48da-8db0-ece3aec22673"
            ],
            [
                "id_localisation" =>  "49",
                "nom_ville" =>  "Odienne",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "64c8023c-f805-4416-94c5-120c8feea318"
            ],
            [
                "id_localisation" =>  "50",
                "nom_ville" =>  "Gonfreville",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "d0897b94-f4cf-4ccd-a81c-051fa1efb657"
            ],
            [
                "id_localisation" =>  "51",
                "nom_ville" =>  "Agnéby",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "ef0952b4-afd8-4356-9e04-2933523ba547"
            ],
            [
                "id_localisation" =>  "52",
                "nom_ville" =>  "Oumé",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "ac102f38-55a2-41eb-9ee5-ed5ae6f15f94"
            ],
            [
                "id_localisation" =>  "54",
                "nom_ville" =>  "Sinfra",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "b858eaad-f9c3-4739-9db8-6063c8d219ea"
            ],
            [
                "id_localisation" =>  "55",
                "nom_ville" =>  "Zuénoula",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "ebefa542-2c9a-44e9-9b6f-d86052e05a02"
            ],
            [
                "id_localisation" =>  "57",
                "nom_ville" =>  "Botro",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "4ed5e423-a0a9-4460-9f6a-af7d4ed67aa0"
            ],
            [
                "id_localisation" =>  "59",
                "nom_ville" =>  "Daoukro",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "1570c610-df73-4d18-9a90-2b5015c18647"
            ],
            [
                "id_localisation" =>  "61",
                "nom_ville" =>  "Lakota",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "c05ca503-410d-4042-a4dc-d0bf7662837b"
            ],
            [
                "id_localisation" =>  "63",
                "nom_ville" =>  "Issia",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "ec12b9a3-2235-420d-8681-a2e1b3334bef"
            ],
            [
                "id_localisation" =>  "64",
                "nom_ville" =>  "Vavoua",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "621ebcbd-7527-421f-b8a6-d249980c3cc2"
            ],
            [
                "id_localisation" =>  "65",
                "nom_ville" =>  "Duékoué",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "de675ddc-e7c9-40b5-bf60-8a45198b9bf6"
            ],
            [
                "id_localisation" =>  "66",
                "nom_ville" =>  "Bangolo",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "3fb9f576-f5ef-4ec3-b305-e6ec329837f9"
            ],
            [
                "id_localisation" =>  "67",
                "nom_ville" =>  "Biankouma",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "d418e955-a425-4678-8b9f-f63bf573856a"
            ],
            [
                "id_localisation" =>  "71",
                "nom_ville" =>  "Touba",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "5e16582a-bf98-4702-90cb-be5c1ce08ea3"
            ],
            [
                "id_localisation" =>  "72",
                "nom_ville" =>  "Bin-Houyé",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "add5cad6-f4da-42d7-a663-a57d497660be"
            ],
            [
                "id_localisation" =>  "77",
                "nom_ville" =>  "Téhini",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "3f772341-8f6f-4209-be3e-8c41e85bf07f"
            ],
            [
                "id_localisation" =>  "80",
                "nom_ville" =>  "Adiaké",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "accc4b65-d1df-4465-92ca-0893c366e1b0"
            ],
            [
                "id_localisation" =>  "82",
                "nom_ville" =>  "Grand-Lahou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "5b0bd620-1de1-483b-bd0b-ab33912abc57"
            ],
            [
                "id_localisation" =>  "84",
                "nom_ville" =>  "Sassandra",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "7b26e499-3239-42b5-afa6-c7c8a710c776"
            ],
            [
                "id_localisation" =>  "85",
                "nom_ville" =>  "San Pedro",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "c1498051-4b7c-4333-a70f-63a69b8da3b2"
            ],
            [
                "id_localisation" =>  "86",
                "nom_ville" =>  "Tabou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "349fd8c7-4714-4654-a67e-6fbb4ecd14f4"
            ],
            [
                "id_localisation" =>  "88",
                "nom_ville" =>  "Sikensi",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "f6247ed3-d728-4f0a-9807-78cc5ee96602"
            ],
            [
                "id_localisation" =>  "90",
                "nom_ville" =>  "Tiassalé",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "be53fc40-5cc4-41a4-a3b1-863bfc1cf4ec"
            ],
            [
                "id_localisation" =>  "91",
                "nom_ville" =>  "Taabo",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "097e5f1c-1d0b-423b-ab47-53fb3154a060"
            ],
            [
                "id_localisation" =>  "92",
                "nom_ville" =>  "Sinfra",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "b41da41f-cf32-4ccf-9e0d-800beab96803"
            ],
            [
                "id_localisation" =>  "94",
                "nom_ville" =>  "Toumodi",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "a914ea62-2cec-479b-9cc8-4fb2f9898676"
            ],
            [
                "id_localisation" =>  "96",
                "nom_ville" =>  "Gohitafla",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "fe4ec94a-26fc-4db3-a0e6-bda2adfa13ae"
            ],
            [
                "id_localisation" =>  "99",
                "nom_ville" =>  "Zouan-Hounien",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "aa492679-aa34-42b4-9b75-57249151ccb8"
            ],
            [
                "id_localisation" =>  "100",
                "nom_ville" =>  "Soubré",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "c385b43b-866a-4848-bb30-17e4dd5bd516"
            ],
            [
                "id_localisation" =>  "103",
                "nom_ville" =>  "Guitry",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "fb7142dc-a921-46aa-b72b-4c8c2ee2aff5"
            ],
            [
                "id_localisation" =>  "104",
                "nom_ville" =>  "Facobly",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "a872054f-e663-48e0-8b66-15999a87f365"
            ],
            [
                "id_localisation" =>  "106",
                "nom_ville" =>  "Touleupleu",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "0d381753-a860-4e08-9a04-41c98483c121"
            ],
            [
                "id_localisation" =>  "109",
                "nom_ville" =>  "Fronan",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "b3e6ab25-a699-416b-becb-f689a94e257a"
            ],
            [
                "id_localisation" =>  "113",
                "nom_ville" =>  "Tiassalé",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "957d3c05-cdbe-4355-9450-6ec1fed9d92e"
            ],
            [
                "id_localisation" =>  "114",
                "nom_ville" =>  "Taabo",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "9f1e7be5-6296-4b1d-acb2-a71f07ad40ba"
            ],
            [
                "id_localisation" =>  "115",
                "nom_ville" =>  "Sikensi",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "2e83d9cb-2105-4b81-97e3-2c25bd3354b8"
            ],
            [
                "id_localisation" =>  "118",
                "nom_ville" =>  "Alépé",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "c1be284b-7ee5-4abf-af0a-a1fa1fe19063"
            ],
            [
                "id_localisation" =>  "120",
                "nom_ville" =>  "Jacqueville",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "e7423f1e-6e33-4b47-9eb4-12d2a407f35e"
            ],
            [
                "id_localisation" =>  "121",
                "nom_ville" =>  "Songon",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "60ac0fe9-59cc-4e3f-bbff-29d745a4bef8"
            ],
            [
                "id_localisation" =>  "123",
                "nom_ville" =>  "Azaguie",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "523fb1cf-e41f-43c5-8f01-4568aaa318e4"
            ],
            [
                "id_localisation" =>  "124",
                "nom_ville" =>  "N'Douci",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "0799ef03-02f1-4124-9acd-75c2df0f7a01"
            ],
            [
                "id_localisation" =>  "126",
                "nom_ville" =>  "Andé",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "48e88b13-d5d4-4fc6-92a8-7afc6a7c3a03"
            ],
            [
                "id_localisation" =>  "127",
                "nom_ville" =>  "M'Bahiakro",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "49c4fbb5-8cb0-4d77-98a1-2c1944856195"
            ],
            [
                "id_localisation" =>  "128",
                "nom_ville" =>  "M'Batto",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "060da984-1d82-49c9-a227-7d8a088da985"
            ],
            [
                "id_localisation" =>  "129",
                "nom_ville" =>  "N'zi-Comoé",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "485213d0-721e-4b70-bdef-51a5db1b6894"
            ],
            [
                "id_localisation" =>  "130",
                "nom_ville" =>  "Tiébissou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "5e4e1f2e-bb62-44e6-ae6e-a4de35437254"
            ],
            [
                "id_localisation" =>  "131",
                "nom_ville" =>  "M'Bengue",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "87c3f38d-c015-4db4-9188-9a1607155086"
            ],
            [
                "id_localisation" =>  "132",
                "nom_ville" =>  "Sakassou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "fd789961-c78e-4d1e-8fbf-5b0d1ed65d2d"
            ],
            [
                "id_localisation" =>  "136",
                "nom_ville" =>  "Vavoua",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "b6b2c2e8-9f8c-4404-bcfc-7fb06ab77efd"
            ],
            [
                "id_localisation" =>  "137",
                "nom_ville" =>  "Zoukougbeu",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "be9aba13-27dd-4628-aa57-0058d0c421a0"
            ],
            [
                "id_localisation" =>  "139",
                "nom_ville" =>  "Toumodi",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "1831dd5e-2356-47d9-9f6e-930c8437f095"
            ],
            [
                "id_localisation" =>  "140",
                "nom_ville" =>  "N'Douci",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "a2187ef5-7492-4f27-a930-7a8065c4e241"
            ],
            [
                "id_localisation" =>  "142",
                "nom_ville" =>  "Sikensi",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "7f2ef1ce-3e78-478d-9288-a6e9f280cb7e"
            ],
            [
                "id_localisation" =>  "144",
                "nom_ville" =>  "Tiassalé",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "1b0e5a1d-cb87-475b-a6bd-689b9aa82f1c"
            ],
            [
                "id_localisation" =>  "145",
                "nom_ville" =>  "Taabo",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "e187ec2d-c28d-4b3a-b17f-a07de591a977"
            ],
            [
                "id_localisation" =>  "146",
                "nom_ville" =>  "M'Pouya",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "d565f9c5-61a8-4a89-9755-ba43c9b0b9c9"
            ],
            [
                "id_localisation" =>  "150",
                "nom_ville" =>  "Sassandra",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "e4972f42-f712-4443-b999-c530e9052b9d"
            ],
            [
                "id_localisation" =>  "151",
                "nom_ville" =>  "San Pedro",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "fba99d82-aa66-405f-8268-c895d9eacfb0"
            ],
            [
                "id_localisation" =>  "152",
                "nom_ville" =>  "Tabou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "1859e2d1-852a-4ad0-99e7-5ad0afc28896"
            ],
            [
                "id_localisation" =>  "153",
                "nom_ville" =>  "Soubré",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "eb964531-a391-431e-aa09-8e1ba56ad43a"
            ],
            [
                "id_localisation" =>  "156",
                "nom_ville" =>  "Vavoua",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "1c230314-d9ee-4b3c-9edb-3e4f09012037"
            ],
            [
                "id_localisation" =>  "163",
                "nom_ville" =>  "Touba",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "17442367-4755-4421-9e7e-3bf6509951b1"
            ],
            [
                "id_localisation" =>  "166",
                "nom_ville" =>  "Téhini",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "ae98adb9-b497-4b0e-8e82-c6503338e841"
            ],
            [
                "id_localisation" =>  "171",
                "nom_ville" =>  "Tingréla",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "70b0f00b-a894-4992-8606-00012678091e"
            ],
            [
                "id_localisation" =>  "172",
                "nom_ville" =>  "Odienné",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "a28ad4ed-e561-49d2-9191-5a43150dccf4"
            ],
            [
                "id_localisation" =>  "173",
                "nom_ville" =>  "Madinani",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "7d49a82f-d9e4-4bcb-9638-5decf7f9c180"
            ],
            [
                "id_localisation" =>  "178",
                "nom_ville" =>  "Téhini",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "986b60a2-fcde-4d82-a3c4-bdfd1a2e2d4e"
            ],
            [
                "id_localisation" =>  "183",
                "nom_ville" =>  "Tingréla",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "7489451e-3a8f-42ff-a60f-8cd84480e4e1"
            ],
            [
                "id_localisation" =>  "184",
                "nom_ville" =>  "Tanda",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "64d3fc3f-dea4-4827-90f1-a54de8899c2f"
            ],
            [
                "id_localisation" =>  "185",
                "nom_ville" =>  "Dabakala",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "cfab6e59-d87d-46f5-85e4-204c5d14b657"
            ],
            [
                "id_localisation" =>  "186",
                "nom_ville" =>  "Prikro",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "20143858-097c-403a-b160-58c9af4e590c"
            ],
            [
                "id_localisation" =>  "189",
                "nom_ville" =>  "Tiébissou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "f17246cd-797a-4cd9-ad75-b135e55f2265"
            ],
            [
                "id_localisation" =>  "190",
                "nom_ville" =>  "M'Batto",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "52bd192d-c771-42ca-9e5d-899c087d005c"
            ],
            [
                "id_localisation" =>  "191",
                "nom_ville" =>  "Djékanou",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "992c6925-1eed-4ece-a5a0-f612444779b0"
            ],
            [
                "id_localisation" =>  "192",
                "nom_ville" =>  "Ettrokro",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "b2e24693-9109-401c-a68f-e941a6eb3568"
            ],
            [
                "id_localisation" =>  "193",
                "nom_ville" =>  "Abongoua",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "85d57743-d7e3-4de7-913a-b21b00128cb6"
            ],
            [
                "id_localisation" =>  "194",
                "nom_ville" =>  "Ouellé",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "8964ceba-5cab-401e-b3af-da4bfc29a5da"
            ],
            [
                "id_localisation" =>  "195",
                "nom_ville" =>  "Kouassi-N'Dawa",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "f5653c72-5d3c-44f7-a165-5337762e9910"
            ],
            [
                "id_localisation" =>  "196",
                "nom_ville" =>  "M'batto",
                "created_at" =>  null,
                "updated_at" =>  null,
                "uuidLocalisation" =>  "4281f98b-2ea8-41cf-a0e6-b104cb907c9c"
            ]

        ];

        Localisation::insert($VilleRecords);
    }
}
