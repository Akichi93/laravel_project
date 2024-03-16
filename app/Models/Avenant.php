<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avenant extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_avenant';

    // protected $dates = ['date_debut', 'date_fin'];

    protected $fillable = [
        'uuidAvenant',
        'uuidContrat',
        'id_contrat',
        'uuidCompagnie',
        'uuidApporteur',
        'annee',
        'mois',
        'type',
        'prime_ttc',
        'retrocession',
        'commission',
        'commission_courtier',
        'prise_charge',
        'ristourne',
        'prime_nette',
        'date_emission',
        'date_debut',
        'date_fin',
        'accessoires',
        'frais_courtier', 
        'cfga', 
        'taxes_totales', 
        'id_entreprise', 
        'payer_courtier', 
        'payer_apporteur', 
        'user_id', 
        'supprimer_avenant', 
        'code_avenant', 
        'solder', 
        'reverser', 
        'sync',
    ];

    // protected $casts = [
    //     'date_debut' => 'datetime:d/m/Y',
    //     'date_fin' => 'datetime:d/m/Y',
    // ];
}
