<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Branche;
use App\Models\Contrat;
use App\Models\Prospect;
use App\Models\Sinistre;
use App\Models\Apporteur;
use App\Models\Automobile;
use App\Models\Compagnie;
use Illuminate\Http\Request;
use App\Models\TauxApporteur;
use App\Models\TauxCompagnie;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    public function importclient(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'import_client' => 'required|file|mimes:csv,txt',
        ]);


        $user = JWTAuth::parseToken()->authenticate();

        $entreprise = $user->id_entreprise;

        $id = $user->id;

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $file = $request->file('import_client');

        // Check if the file is empty
        if ($file->getSize() === 0) {
            return response()->json(['error' => 'Le fichier CSV est vide.'], 422);
        }

        // Define expected data types for each column
        $expectedTypes = [
            'civilite' => 'string',
            'nom_client' => 'string',
            'postal_client' => 'string',
            'adresse_client' => 'string',
            'tel_client' => 'string',
            'profession_client' => 'string',
            'fax_client' => 'string',
            'email_client' => 'email',
            'numero_client' => 'string',
        ];

        // Process CSV data in batches
        $batchSize = 1000; // Nombre de lignes par lot

        $csvFile = fopen($file->getPathname(), 'r');
        $header = fgetcsv($csvFile); // Get the header

        // Validate the headers
        $validator = $this->validateHeaders($header, array_keys($expectedTypes));
        if ($validator->fails()) {
            fclose($csvFile);
            return response()->json(['error' => 'Les en-têtes ne correspondent pas : ' . $validator->errors()->first()], 422);
        }

        $pcreate_data = [];
        $processedRows = [];
        $duplicateRows = [];

        while (($getData = fgetcsv($csvFile, 10000, ",")) !== false) {
            // Check for duplicate rows
            $hash = md5(implode(',', $getData));
            if (in_array($hash, $processedRows)) {
                $duplicateRows[] = $getData;
            } else {
                $processedRows[] = $hash;

                // Validate the data types of each column
                $validator = $this->validateDataTypes($getData, $expectedTypes);
                if ($validator->fails()) {
                    fclose($csvFile);
                    return response()->json(['error' => 'Type de données incorrect dans une colonne : ' . $validator->errors()->first()], 422);
                }

                $pcreate_data[] = array_combine($header, $getData) + [
                    'id_entreprise' => $entreprise,
                    'user_id' => $id,
                ];
            }

            // Si le lot est prêt ou si nous avons atteint la fin du fichier
            if (count($pcreate_data) >= $batchSize || feof($csvFile)) {
                // Insérer le lot dans la base de données
                $this->insertBatchData($pcreate_data);

                // Réinitialiser le tableau pour le prochain lot
                $pcreate_data = [];
            }
        }

        fclose($csvFile);

        if (!empty($duplicateRows)) {
            return response()->json(['success' => 'Base de données clients importée avec succès, mais des doublons ont été détectés.', 'duplicates' => $duplicateRows], 200);
        }

        return response()->json(['success' => 'Base de données clients importée avec succès'], 200);
    }

    public function importprospect(Request $request)
    {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'import_prospect' => 'required|file|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $user = JWTAuth::parseToken()->authenticate();
        $entreprise = $user->id_entreprise;
        $id = $user->id;

        $file = $request->file('import_prospect');

        // Check if the file is empty
        if ($file->getSize() === 0) {
            return response()->json(['error' => 'Le fichier CSV est vide.'], 422);
        }

        // Define expected data types for each column
        $expectedTypes = [
            'civilite' => 'string',
            'nom_prospect' => 'string',
            'postal_prospect' => 'string',
            'adresse_prospect' => 'string',
            'tel_prospect' => 'string',
            'profession_prospect' => 'string',
            'fax_prospect' => 'string',
            'email_prospect' => 'email',
        ];

        // Process CSV data in batches
        $batchSize = 1000; // Nombre de lignes par lot

        $csvFile = fopen($file->getPathname(), 'r');
        $header = fgetcsv($csvFile); // Get the header

        // Validate the headers
        $validator = $this->validateHeadersProspect($header, array_keys($expectedTypes));
        if ($validator->fails()) {
            fclose($csvFile);
            return response()->json(['error' => 'Les en-têtes ne correspondent pas : ' . $validator->errors()->first()], 422);
        }

        $pcreate_data = [];
        $processedEmails = [];
        $duplicateRows = [];

        while (($getData = fgetcsv($csvFile, 10000, ",")) !== false) {
            // Validate the data types of each column
            $validator = $this->validateDataTypesProspect($getData, $expectedTypes);
            if ($validator->fails()) {
                fclose($csvFile);
                return response()->json(['error' => 'Type de données incorrect dans une colonne : ' . $validator->errors()->first()], 422);
            }

            $email = $getData[array_search('email_prospect', $header)];

            // Check for duplicate emails
            if (in_array($email, $processedEmails)) {
                $duplicateRows[] = $getData;
            } else {
                $processedEmails[] = $email;

                $pcreate_data[] = array_combine($header, $getData) + [
                    'id_entreprise' => $entreprise,
                    'user_id' => $id,
                ];
            }

            // Si le lot est prêt ou si nous avons atteint la fin du fichier
            if (count($pcreate_data) >= $batchSize || feof($csvFile)) {
                // Insérer le lot dans la base de données
                $this->insertBatchDataProspect($pcreate_data);

                // Réinitialiser le tableau pour le prochain lot
                $pcreate_data = [];
            }
        }

        fclose($csvFile);

        if (!empty($duplicateRows)) {
            return response()->json(['success' => 'Base de données prospects importé avec succès, mais des doublons ont été détectés.', 'duplicates' => $duplicateRows], 200);
        }

        return response()->json(['success' => 'Base de données prospects importée avec succès'], 200);
    }

    public function importapporteur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'import_apporteur' => 'required|file|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $user = JWTAuth::parseToken()->authenticate();
        $entreprise = $user->id_entreprise;
        $id = $user->id;

        $file = $request->file('import_apporteur');


        // Check if the file is empty
        if ($file->getSize() === 0) {
            return response()->json(['error' => 'Le fichier CSV est vide.'], 422);
        }

        // Define expected data types for each column
        $expectedTypes = [
            'nom_apporteur' => 'string',
            'email_apporteur' => 'email',
            'adresse_apporteur' => 'string',
            'contact_apporteur' => 'string',
            'code_apporteur' => 'string',
            'code_postal' => 'string',
        ];

        // Process CSV data in batches
        $batchSize = 1000; // Nombre de lignes par lot

        $csvFile = fopen($file->getPathname(), 'r');
        $header = fgetcsv($csvFile); // Get the header

        // Validate the headers
        $validator = $this->validateHeadersApporteur($header, array_keys($expectedTypes));
        if ($validator->fails()) {
            fclose($csvFile);
            return response()->json(['error' => 'Les en-têtes ne correspondent pas : ' . $validator->errors()->first()], 422);
        }

        $pcreate_data = [];
        $processedEmails = [];
        $duplicateRows = [];

        while (($getData = fgetcsv($csvFile, 10000, ",")) !== false) {
            // Validate the data types of each column
            $validator = $this->validateDataTypesApporteur($getData, $expectedTypes);
            if ($validator->fails()) {
                fclose($csvFile);
                return response()->json(['error' => 'Type de données incorrect dans une colonne : ' . $validator->errors()->first()], 422);
            }

            $email = $getData[array_search('email_apporteur', $header)];

            // Check for duplicate emails
            if (in_array($email, $processedEmails)) {
                $duplicateRows[] = $getData;
            } else {
                $processedEmails[] = $email;

                $pcreate_data[] = array_combine($header, $getData) + [
                    'id_entreprise' => $entreprise,
                    'user_id' => $id,
                ];
            }

            // Si le lot est prêt ou si nous avons atteint la fin du fichier
            if (count($pcreate_data) >= $batchSize || feof($csvFile)) {
                // Insérer le lot dans la base de données
                $this->insertBatchDataApporteur($pcreate_data);

                // Réinitialiser le tableau pour le prochain lot
                $pcreate_data = [];
            }
        }

        fclose($csvFile);

        if (!empty($duplicateRows)) {
            return response()->json(['success' => 'Base de données prospects importé avec succès, mais des doublons ont été détectés.', 'duplicates' => $duplicateRows], 200);
        }

        return response()->json(['success' => 'Base de données prospects importée avec succès'], 200);
    }

    public function importauxapporteur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'import_tauxapporteur' => ['required', 'file', 'mimes:csv,txt', 'max:10240'] // Adjust max file size as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $file = $request->file('import_tauxapporteur');

        try {
            DB::beginTransaction();

            $header = $this->getCSVHeaderTauxApporteur($file);

            if (!$this->validateCSVHeaderTauxApporteur($header)) {
                throw new \Exception('Les en-têtes du fichier ne correspondent pas aux attentes.');
            }

            $tauxapporteur = $this->parseCSVDataTauxApporteur($file, $header);

            $this->processCSVDataTauxApporteur($tauxapporteur);

            DB::commit();
            return response()->json(['success' => true, 'data' => $tauxapporteur], 200);
        } catch (\Exception $e) {
            \Log::error('Error importing data: ' . $e->getMessage());
            DB::rollBack();
            return response()->json(['error' => 'Une erreur est survenue lors de l\'importation. Veuillez réessayer.'], 500);
        }
    }

    public function importcompagnie(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'import_compagnie' => 'required|file|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $user = JWTAuth::parseToken()->authenticate();
        $entreprise = $user->id_entreprise;
        $id = $user->id;

        $file = $request->file('import_apporteur');

        // Check if the file is empty
        if ($file->getSize() === 0) {
            return response()->json(['error' => 'Le fichier CSV est vide.'], 422);
        }

        // Define expected data types for each column
        $expectedTypes = [
            'nom_compagnie' => 'string',
            'adresse_compagnie' => 'string',
            'email_compagnie' => 'email',
            'contact_compagnie' => 'string',
            'postal_compagnie' => 'string',
            'code_compagnie' => 'string',
        ];

        $batchSize = 1000; // Nombre de lignes par lot

        $csvFile = fopen($file->getPathname(), 'r');
        $header = fgetcsv($csvFile); // Get the header

        // Validate the headers
        $validator = $this->validateHeadersCompagnie($header, array_keys($expectedTypes));
        if ($validator->fails()) {
            fclose($csvFile);
            return response()->json(['error' => 'Les en-têtes ne correspondent pas : ' . $validator->errors()->first()], 422);
        }


        $pcreate_data = [];
        $processedEmails = [];
        $duplicateRows = [];

        while (($getData = fgetcsv($csvFile, 10000, ",")) !== false) {
            // Validate the data types of each column
            $validator = $this->validateDataTypesCompagnie($getData, $expectedTypes);
            if ($validator->fails()) {
                fclose($csvFile);
                return response()->json(['error' => 'Type de données incorrect dans une colonne : ' . $validator->errors()->first()], 422);
            }

            $email = $getData[array_search('email_compagnie', $header)];

            // Check for duplicate emails
            if (in_array($email, $processedEmails)) {
                $duplicateRows[] = $getData;
            } else {
                $processedEmails[] = $email;

                $pcreate_data[] = array_combine($header, $getData) + [
                    'id_entreprise' => $entreprise,
                    'user_id' => $id,
                ];
            }

            // Si le lot est prêt ou si nous avons atteint la fin du fichier
            if (count($pcreate_data) >= $batchSize || feof($csvFile)) {
                // Insérer le lot dans la base de données
                $this->insertBatchCompagnie($pcreate_data);

                // Réinitialiser le tableau pour le prochain lot
                $pcreate_data = [];
            }
        }

        fclose($csvFile);

        if (!empty($duplicateRows)) {
            return response()->json(['success' => 'Base de données prospects importé avec succès, mais des doublons ont été détectés.', 'duplicates' => $duplicateRows], 200);
        }

        return response()->json(['success' => 'Base de données prospects importée avec succès'], 200);
    }

    public function importauxcompagnie(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'import_tauxcompagnie' => ['required', 'file', 'mimes:csv,txt', 'max:10240'] // Adjust max file size as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $file = $request->file('import_tauxcompagnie');


        try {
            DB::beginTransaction();

            $header = $this->getCSVHeaderTauxCompagnie($file);

            if (!$this->validateCSVHeaderTauxCompagnie($header)) {
                throw new \Exception('Les en-têtes du fichier ne correspondent pas aux attentes.');
            }

            $tauxcompagnie = $this->parseCSVDataTauxCompagnie($file, $header);

            $this->processCSVDataTauxCompagnie($tauxcompagnie);

            DB::commit();
            return response()->json(['success' => true, 'data' => $tauxcompagnie], 200);
        } catch (\Exception $e) {
            \Log::error('Error importing data: ' . $e->getMessage());
            DB::rollBack();
            return response()->json(['error' => 'Une erreur est survenue lors de l\'importation. Veuillez réessayer.'], 500);
        }
    }

    public function importcontrat(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'import_contrat' => ['required', 'file', 'mimes:csv,txt', 'max:10240'] // Adjust max file size as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $file = $request->file('import_contrat');

        try {
            DB::beginTransaction();

            $header = $this->getCSVHeaderContrat($file);

            if (!$this->validateCSVHeaderContrat($header)) {
                throw new \Exception('Les en-têtes du fichier ne correspondent pas aux attentes.');
            }

            $contrat = $this->parseCSVDataContrat($file, $header);

            $this->processCSVDataContrat($contrat);

            DB::commit();
            return response()->json(['success' => true, 'data' => $contrat], 200);
        } catch (\Exception $e) {
            \Log::error('Error importing data: ' . $e->getMessage());
            DB::rollBack();
            return response()->json(['error' => 'Une erreur est survenue lors de l\'importation. Veuillez réessayer.'], 500);
        }
    }


    public function importsinistre(Request $request)
    {
        $request->validate([
            'import_sinistre' => ['file']
        ]);

        // if (!empty($request->import_sinistre)) {
        //     $file = $request->import_sinistre;
        //     $rows  = array_map("str_getcsv", file($file, FILE_SKIP_EMPTY_LINES));
        //     $header = array_shift($rows);
        //     $f = fopen($file, "r");
        //     $firstLine = fgets($f); //get first line of csv file
        //     fclose($f); // close file
        //     $foundHeaders = str_getcsv(trim($firstLine), ',', '"'); //parse to array

        //     $requiredHeaders = array('numero_police', 'date_survenance', 'heure', 'date_declaration', 'date_ouverture ', 'date_decla_compagnie', 'numero_sinistre', 'reference_compagnie', 'gestion_compagnie', 'materiel_sinistre', 'ipp', 'garantie_applique', ' recours_sinistre', 'date_mission', ' accident_sinistre', 'lieu_sinistre', 'expert', 'commentaire_sinistre');

        //     if ($foundHeaders !== $requiredHeaders) {
        //         echo 'Headers do not match: ' . implode(', ', $foundHeaders);
        //         return back()->with('success', 'Veuillez entrer la bonne base');
        //     } else {
        $filePath = $request->import_sinistre;
        $file = fopen($filePath, 'r');

        $header = fgetcsv($file);

        $sinistres = [];
        while ($row = fgetcsv($file)) {
            $sinistres[] = array_combine($header, $row);
        }

        fclose($file);

        return view('parametre.upload', compact('sinistres'));
        // }
        // }
    }

    public function importautomobile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'import_auto' => ['required', 'file', 'mimes:csv,txt', 'max:10240'] // Adjust max file size as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $file = $request->file('import_auto');


        if (!empty($request->import_auto)) {
            $file = $request->import_auto;
            $rows  = array_map("str_getcsv", file($file, FILE_SKIP_EMPTY_LINES));
            $header = array_shift($rows);
            $f = fopen($file, "r");
            $firstLine = fgets($f);
            //get first line of csv file
            fclose($f); // close file
            $foundHeaders = str_getcsv(trim($firstLine), ',', '"'); //parse to array

            $requiredHeaders = array('numero_immatriculation', 'identification_proprietaire', 'date_circulation', 'adresse_proprietaire', 'categorie', 'marque', 'genre', 'type', 'carosserie', 'couleur', 'option', 'entree', 'energie', 'place', 'puissance', 'charge', 'valeur_venale', 'categorie_socio_professionelle', 'permis', 'frais_courtier', 'accessoires', 'cfga', 'taxes_totales', 'prime_ttc', 'commission_courtier', 'gestion', 'commission_apporteur', 'type_garantie', 'zone');


            if ($foundHeaders !== $requiredHeaders) {
                echo 'Headers do not match: ' . implode(', ', $foundHeaders);
                return response()->json('Veuillez entrer la bonne base');
                // return back()->with('success', 'Veuillez entrer la bonne base');
            } else {
                $file = $request->import_auto;

                // Open uploaded CSV file with read-only mode
                $csvFile  = fopen($file, "r");

                // Skip the first line
                fgetcsv($csvFile);

                // Parse data from CSV file line by line
                while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE) {
                    // Get row data
                    $numero_immatriculation[] = $getData[0];
                    $identification_proprietaire[] = $getData[1];
                    $date_circulation[] = $getData[2];
                    $adresse_proprietaire[] = $getData[3];
                    $categorie[] = $getData[4];
                    $marque[] = $getData[5];
                    $genre[] = $getData[6];
                    $type[] = $getData[7];
                    $carosserie[] = $getData[8];
                    $couleur[] = $getData[9];
                    $option[] = $getData[10];
                    $entree[] = $getData[11];
                    $energie[] = $getData[12];
                    $place[] = $getData[13];
                    $puissance[] = $getData[14];
                    $charge[] = $getData[15];
                    $valeur_venale[] = $getData[16];
                    $categorie_socio_professionelle[] = $getData[17];
                    $permis[] = $getData[18];
                    $frais_courtier[] = $getData[19];
                    $accessoires[] = $getData[20];
                    $cfga[] = $getData[21];
                    $taxes_totales[] = $getData[22];
                    $prime_ttc[] = $getData[23];
                    $commission_courtier[] = $getData[24];
                    $gestion[] = $getData[25];
                    $commission_apporteur[] = $getData[26];
                    $type_garantie[] = $getData[27];
                    $zone[] = $getData[28];
                  


                    $pcreate_data[] =
                        array(
                            'numero_immatriculation' => $getData[0],
                            'identification_proprietaire' => $getData[1],
                            'date_circulation' => $getData[2],
                            'adresse_proprietaire' => $getData[3],
                            'categorie' => $getData[4],
                            'marque' => $getData[5],
                            'genre' => $getData[6],
                            'type' => $getData[7],
                            'carosserie' => $getData[8],
                            'couleur' => $getData[9],
                            'option' => $getData[10],
                            'entree' => $getData[11],
                            'energie' => $getData[12],
                            'place' => $getData[13],
                            'puissance' => $getData[14],
                            'charge' => $getData[15],
                            'valeur_venale' => $getData[16],
                            'categorie_socio_professionelle' => $getData[17],
                            'permis' => $getData[18],
                            'frais_courtier' => $getData[19],
                            'accessoires' => $getData[20],
                            'cfga' => $getData[21],
                            'taxes_totales' => $getData[22],
                            'prime_ttc' => $getData[23],
                            'commission_courtier' => $getData[24],
                            'gestion' => $getData[25],
                            'commission_apporteur' => $getData[26],
                            'type_garantie' => $getData[27],
                            'zone' => $getData[28],
                           

                        );
                }

                foreach ($pcreate_data as $data) {
                    Automobile::create($data);
                }

                return back()->with('success', 'Base de donnees clients importes');
            }
        }
    }


    // Validation des entetes de l'importation clients
    private function validateHeaders($headers, $expectedHeaders)
    {
        return Validator::make($headers, [
            '*' => 'in:' . implode(',', $expectedHeaders),
        ]);
    }

    // Validation des types de données de la base clients
    private function validateDataTypes($data, $expectedTypes)
    {
        $rules = [];
        foreach ($expectedTypes as $column => $type) {
            $rules[$column] = $type;
        }

        return Validator::make($data, $rules);
    }

    // insertion dans la de données clients
    private function insertBatchData($batchData)
    {
        try {
            DB::beginTransaction();

            foreach ($batchData as $data) {
                Client::create($data);
            }
            \Log::info('Inserting batch dataclient: ' . json_encode($batchData));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error during client import: ' . $e->getMessage());
            // Gérer l'erreur si nécessaire
        }
    }

    // Validation des entetes de la base prospect
    private function validateHeadersProspect($headers, $expectedHeaders)
    {
        return Validator::make($headers, [
            '*' => 'in:' . implode(',', $expectedHeaders),
        ]);
    }

    // Validation des types de données de la base prospect
    private function validateDataTypesProspect($data, $expectedTypes)
    {
        $rules = [];
        foreach ($expectedTypes as $column => $type) {
            $rules[$column] = $type;
        }

        return Validator::make($data, $rules);
    }

    // Insertion des clients dans la table
    private function insertBatchDataProspect($batchDataProspect)
    {
        try {
            DB::beginTransaction();

            foreach ($batchDataProspect as $data) {
                // Check for existing prospect by email
                $existingProspect = Prospect::where('email_prospect', $data['email_prospect'])->first();

                if (!$existingProspect) {
                    Prospect::create($data);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error during prospect import: ' . $e->getMessage());
            // Gérer l'erreur si nécessaire
        }
    }

    // Validation des entetes de la base apporteur
    private function validateHeadersApporteur($headers, $expectedHeaders)
    {
        return Validator::make($headers, [
            '*' => 'in:' . implode(',', $expectedHeaders),
        ]);
    }

    // Validation des types de données de la base apporteur
    private function validateDataTypesApporteur($data, $expectedTypes)
    {
        $rules = [];
        foreach ($expectedTypes as $column => $type) {
            $rules[$column] = $type;
        }

        return Validator::make($data, $rules);
    }

    // Insertion des apporteurs dans la table
    private function insertBatchDataApporteur($batchDataApporteur)
    {
        try {
            DB::beginTransaction();

            foreach ($batchDataApporteur as $data) {
                // Check for existing prospect by email
                $existingProspect = Apporteur::where('email_apporteur', $data['email_apporteur'])->first();

                if (!$existingProspect) {
                    Apporteur::create($data);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error during prospect import: ' . $e->getMessage());
            // Gérer l'erreur si nécessaire
        }
    }

    // Obtenir les entetes de la base taux apporteur
    private function getCSVHeaderTauxApporteur($file)
    {
        $fileResource = fopen($file, 'r');
        $header = fgetcsv($fileResource);
        fclose($fileResource);

        return $header;
    }

    // Valider les entetes de la base taux apporteur
    private function validateCSVHeaderTauxApporteur($header)
    {
        $requiredHeaders = ['code_apporteur', 'nom_branche', 'taux'];
        sort($header);
        sort($requiredHeaders);
        return array_map('strtolower', $header) == array_map('strtolower', $requiredHeaders);
    }

    // 
    private function parseCSVDataTauxApporteur($file, $header)
    {
        $tauxapporteur = [];
        $fileResource = fopen($file, 'r');

        while ($row = fgetcsv($fileResource)) {
            $tauxapporteur[] = array_combine($header, $row);
        }

        fclose($fileResource);
        return $tauxapporteur;
    }

    private function processCSVDataTauxApporteur($tauxapporteur)
    {
        // Remove the header
        $header = array_shift($tauxapporteur);

        // Initialize arrays to store values
        $apporteurIds = [];
        $brancheIds = [];
        $tauxValues = [];

        foreach ($tauxapporteur as $data) {
            $apporteur = Apporteur::where('code_apporteur', $data['code_apporteur'])->first();
            $branche = Branche::where('nom_branche', $data['nom_branche'])->first();

            if ($apporteur && $branche) {
                // Assign directly to the array using references
                $apporteurIds[] = $apporteur->id_apporteur;
                $brancheIds[] = $branche->id_branche;

                // Store the 'taux' value in the array
                $tauxValues[] = $data['taux'];
            } else {
                \Log::error('Correspondance d\'apporteur ou de branche non trouvée. Code apporteur : ' . $data['code_apporteur'] . ', Nom branche : ' . $data['nom_branche']);
                throw new \Exception('Correspondance d\'apporteur ou de branche non trouvée. Code apporteur : ' . $data['code_apporteur'] . ', Nom branche : ' . $data['nom_branche']);
            }

            $tauxValues[] = $data['taux'];
        }

        // Stockage des données dans la base de données
        foreach ($tauxapporteur as $key => $data) {
            try {
                // Use individual values, not arrays
                TauxApporteur::create([
                    'id_apporteur' => $apporteurIds[$key] ?? null,
                    'id_branche' => $brancheIds[$key] ?? null,
                    'taux' => $tauxValues[$key] ?? null,
                ]);
            } catch (\Exception $e) {
                \Log::error('Error inserting data into taux_apporteurs: ' . $e->getMessage());
                \Log::error('Failed data: ' . json_encode($data));
            }
        }
    }

    // Validation des entetes de la base compagnie
    private function validateHeadersCompagnie($headers, $expectedHeaders)
    {
        return Validator::make($headers, [
            '*' => 'in:' . implode(',', $expectedHeaders),
        ]);
    }

    // Validation des types de données de la base compagnie
    private function validateDataTypesCompagnie($data, $expectedTypes)
    {
        $rules = [];
        foreach ($expectedTypes as $column => $type) {
            $rules[$column] = $type;
        }

        return Validator::make($data, $rules);
    }

    // Insertion des compagnues dans la table
    private function insertBatchCompagnie($batchDataApporteur)
    {
        try {
            DB::beginTransaction();

            foreach ($batchDataApporteur as $data) {
                // Check for existing prospect by email
                $existingCompagnie = Compagnie::where('email_compagnie', $data['email_compagnie'])->first();

                if (!$existingCompagnie) {
                    Compagnie::create($data);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error during compagnie import: ' . $e->getMessage());
            // Gérer l'erreur si nécessaire
        }
    }

    // Obtenir les entetes de la base taux compagnie
    private function getCSVHeaderTauxCompagnie($file)
    {
        $fileResource = fopen($file, 'r');
        $header = fgetcsv($fileResource);
        fclose($fileResource);

        return $header;
    }

    // Valider les entetes de la base taux compagnie
    private function validateCSVHeaderTauxCompagnie($header)
    {
        $requiredHeaders = ['code_apporteur', 'nom_branche', 'taux'];
        sort($header);
        sort($requiredHeaders);
        return array_map('strtolower', $header) == array_map('strtolower', $requiredHeaders);
    }

    //
    private function parseCSVDataTauxCompagnie($file, $header)
    {
        $tauxcompagnie = [];
        $fileResource = fopen($file, 'r');

        while ($row = fgetcsv($fileResource)) {
            $tauxcompagnie[] = array_combine($header, $row);
        }

        fclose($fileResource);
        return $tauxcompagnie;
    }

    // Insertion de la base taux compagnie
    private function processCSVDataTauxCompagnie($tauxcompagnie)
    {
        // Remove the header
        $header = array_shift($tauxcompagnie);

        // Initialize arrays to store values
        $compagnieIds = [];
        $brancheIds = [];
        $tauxValues = [];

        foreach ($tauxcompagnie as $data) {
            $compagnie = Compagnie::where('code_compagnie', $data['code_compagnie'])->first();
            $branche = Branche::where('nom_branche', $data['nom_branche'])->first();

            if ($compagnie && $branche) {
                // Assign directly to the array using references
                $apporteurIds[] = $compagnie->id_compagnie;
                $brancheIds[] = $branche->id_branche;

                // Store the 'taux' value in the array
                $tauxValues[] = $data['taux'];
            } else {
                \Log::error('Correspondance d\'apporteur ou de branche non trouvée. Code apporteur : ' . $data['code_compagnie'] . ', Nom branche : ' . $data['nom_branche']);
                throw new \Exception('Correspondance d\'apporteur ou de branche non trouvée. Code apporteur : ' . $data['code_compagnie'] . ', Nom branche : ' . $data['nom_branche']);
            }
        }

        // Stockage des données dans la base de données
        foreach ($tauxcompagnie as $key => $data) {
            try {
                // Use individual values, not arrays
                TauxCompagnie::create([
                    'id_compagnie' => $compagnieIds[$key] ?? null,
                    'id_branche' => $brancheIds[$key] ?? null,
                    'tauxcomp' => $tauxValues[$key] ?? null,
                ]);
            } catch (\Exception $e) {
                \Log::error('Error inserting data into taux_apporteurs: ' . $e->getMessage());
                \Log::error('Failed data: ' . json_encode($data));
            }
        }
    }

    // Obtenir les entetes de la base contrat
    private function getCSVHeaderContrat($file)
    {
        $fileResource = fopen($file, 'r');
        $header = fgetcsv($fileResource);
        fclose($fileResource);

        return $header;
    }

    // Valider les entetes de la base contrat
    private function validateCSVHeaderContrat($header)
    {
        $requiredHeaders = ['nom_branche', 'nom_client', 'nom_compagnie', 'nom_apporteur', 'n_police ', 'souscrit_le', 'effet_police', 'heure_police', 'expire_le', 'reconduction', 'prime_nette', 'frais_courtier', ' accessoire', 'cfga', ' taxes_totales', 'prime_ttc', 'commission_courtier', 'gestion', 'commision_apporteur', 'solde', 'reverse'];
        sort($header);
        sort($requiredHeaders);
        return array_map('strtolower', $header) == array_map('strtolower', $requiredHeaders);
    }

    //
    private function parseCSVDataContrat($file, $header)
    {
        $contrat = [];
        $fileResource = fopen($file, 'r');

        while ($row = fgetcsv($fileResource)) {
            $contrat[] = array_combine($header, $row);
        }

        fclose($fileResource);
        return $contrat;
    }

    // Insertion de la base contrat
    private function processCSVDataContrat($contrat)
    {
        // Remove the header
        $header = array_shift($contrat);

        $user = JWTAuth::parseToken()->authenticate();
        $entreprise = $user->id_entreprise;
        $id = $user->id;

        // Initialize arrays to store values
        $compagnieIds = $apporteurIds = $clientIds = $brancheIds = [];
        $policeValues = $souscritValues = $effetValues = $heureValues = [];
        $expireValues = $reconductionValues = $primettcValues = [];
        $fraisValues = $accessoiresValues = $taxesValues = $cfgaValues = [];
        $commissioncourtierValues = $gestionValues = $commissionapporteurValues = [];
        $solderValues = $reverserValues = [];

        foreach ($contrat as $data) {
            $compagnie = Compagnie::where('nom_compagnie', $data['nom_compagnie'])->first();
            $apporteur = Apporteur::where('nom_apporteur', $data['nom_apporteur'])->first();
            $client = Client::where('nom_client', $data['nom_client'])->first();
            $branche = Branche::where('nom_branche', $data['nom_branche'])->first();

            $solderValues[] = ($data['solde'] == 'OUI') ? 0 : 1;
            $reverserValues[] = ($data['reverse'] == 'OUI') ? 0 : 1;

            if ($compagnie && $apporteur && $branche && $client) {
                // Assign directly to the array using references
                $apporteurIds[] = $apporteur->id_apporteur;
                $compagnieIds[] = $compagnie->id_compagnie;
                $clientIds[] = $client->id_client;
                $brancheIds[] = $branche->id_branche;
            } else {
                \Log::error('Correspondance d\'apporteur ou de branche non trouvée. Code apporteur : ' . $data['code_compagnie'] . ', Nom branche : ' . $data['nom_branche']);
                throw new \Exception('Correspondance d\'apporteur ou de branche non trouvée. Code apporteur : ' . $data['code_compagnie'] . ', Nom branche : ' . $data['nom_branche']);
            }

            $policeValues[] = $data['numero_police'];
            $souscritValues[] = $data['souscrit_le'];
            $effetValues[] = $data['effet_police'];
            $heureValues[] = $data['heure_police'];
            $expireValues[] = $data['expire_le'];
            $reconductionValues[] = $data['reconduction'];
            $primenetteValues[] = $data['prime_nette'];
            $fraisValues[] = $data['frais_courtier'];
            $accessoiresValues[] = $data['accessoires'];
            $taxesValues[] = $data['taxes_totales'];
            $cfgaValues[] = $data['cfga'];
            $primettcValues[] = $data['prime_ttc'];
            $commissioncourtierValues[] = $data['commission_courtier'];
            $gestionValues[] = $data['gestion'];
            $commissionapporteurValues[] = $data['commission_apporteur'];
            $solderValues[] = $solderValues;
            $solderValues[] = $solderValues;
        }

        // Stockage des données dans la base de données
        foreach ($contrat as $key => $data) {
            try {
                // Use individual values, not arrays
                Contrat::create([
                    'id_branche' => $brancheIds[$key] ?? null,
                    'id_client' => $clientIds[$key] ?? null,
                    'id_compagnie' => $compagnieIds[$key] ?? null,
                    'id_apporteur' => $apporteurIds[$key] ?? null,
                    'numero_police' => $policeValues[$key] ?? null,
                    'souscrit_le' => $souscritValues[$key] ?? null,
                    'effet_police' => $effetValues[$key] ?? null,
                    'heure_police' => $heureValues[$key] ?? null,
                    'expire_le' => $expireValues[$key] ?? null,
                    'reconduction' => $reconductionValues[$key] ?? null,
                    'prime_nette' => $primenetteValues[$key] ?? null,
                    'frais_courtier' => $fraisValues[$key] ?? null,
                    'accessoires' => $accessoiresValues[$key] ?? null,
                    'cfga' => $cfgaValues[$key] ?? null,
                    'taxes_totales' => $taxesValues[$key] ?? null,
                    'prime_ttc' => $primettcValues[$key] ?? null,
                    'commission_courtier' => $commissioncourtierValues[$key] ?? null,
                    'gestion' => $gestionValues[$key] ?? null,
                    'commission_apporteur' => $commissionapporteurValues[$key] ?? null,
                    'solde' => $solderValues[$key] ?? null,
                    'reverse' => $reverserValues[$key] ?? null,
                    'id_entreprise' => $entreprise,
                    'user_id' => $id,
                ]);
            } catch (\Exception $e) {
                \Log::error('Error inserting data into taux_apporteurs: ' . $e->getMessage());
                \Log::error('Failed data: ' . json_encode($data));
            }
        }
    }
}
