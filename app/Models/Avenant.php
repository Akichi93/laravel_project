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
        'id_contrat',
        'type',
        'prime_ttc',
        'commission',
        'retrocession',
        'prise_charge',
        'prime_nette',
        'accessoires',
        'frais_courtier',
        'cfga',
        'taxes_totales',
        'solde',
        'reverse',
    ];

    // protected $casts = [
    //     'date_debut' => 'datetime:d/m/Y',
    //     'date_fin' => 'datetime:d/m/Y',
    // ];
}
