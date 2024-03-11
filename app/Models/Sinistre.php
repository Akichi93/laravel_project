<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sinistre extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_sinistre';

    // protected $dates = ['date_survenance','date_declaration'];

    protected $fillable = [
        'id_contrat',
        'date_survenance',
        'heure',
        'date_declaration',
        'date_ouverture',
        'date_decla_compagnie',
        'numero_sinistre',
        'reference_compagnie',
        'gestion_compagnie',
        'materiel_sinistre',
        'ipp',
        'garantie_applique',
        'recours_sinistre',
        'date_mission',
        'accident_sinistre',
        'lieu_sinistre',
        'expert',
        'commentaire_sinistre',
        'etat',
        'id_entreprise',
        'user_id',
    ];

    // protected $casts = [
    //     'date_survenance' => 'datetime:d/m/Y',
    //     'date_declaration' => 'datetime:d/m/Y',
    // ];
}
