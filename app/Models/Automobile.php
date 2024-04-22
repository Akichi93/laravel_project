<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Automobile extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_automobile';

    protected $fillable = [
        'uuidAutomobile',
        'uuidContrat',
        'id_contrat',
        'numero_immatriculation',
        'identification_proprietaire',
        'date_circulation',
        'adresse_proprietaire',
        'categorie',
        'marque',
        'genre',
        'type',
        'carosserie',
        'couleur',
        'option',
        'energie',
        'place',
        'puissance',
        'valeur_neuf',
        'valeur_ venale',
        'categorie_socio_pro',
        'permis',
        'prime_nette',
        'frais_courtier',
        'accesoires',
        'cfga',
        'taxes_totales',
        'primes_ttc',
        'comission',
        'gestion',
        'comission_apporteur',
        'id_entreprise',
    ];

    public function contrats() {
        return $this->belongsToMany(Contrat::class,'automobile_contrat', 'id_automobile','id_contrat');
    }
}
