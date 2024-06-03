<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarificateurAccident extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuidTarificationAccident',
        'uuidProspect',
        'uuidCompagnie',
        'nom_complet',
        'activite',
        'effectif',
        'duree',
        'deces',
        'ipt',
        'frais_medicaux',
        'prime_nette_brute',
        'taux_reduction_effectif',
        'prime_nette_reduite',
        'prime_nette_annuelle',    
        'accessoire_annuel',    
        'taxe_annuelle',    
        'prime_ttc_annuelle',    
        'prime_nette_courte',    
        'taux_reduction_duree',    
        'accesoire_courte',    
        'taxe_courte',    
        'prime_ttc_courte',    
        'prime_ttc_courte',    
        'id_prospect',    
        'id_compagnie',   
        'sync',
    ];
}
