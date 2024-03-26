<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_contrat';

    protected $fillable = [
        'id_branche',
        'id_client',
        'id_compagnie',
        'id_apporteur',
        'numero_police',
        'souscrit_le',
        'effet_police',
        'heure_police',
        'expire_le',
        'reconduction',
        'prime_nette',
        'frais_courtier',
        'accessoires',
        'cfga',
        'taxes_totales',
        'commission_courtier',
        'commission_apporteur',
        'gestion',
        'solde',
        'reverse',
        'id_entreprise',
        'user_id',
        'prime_ttc',
        'commission_apporteur',
        'commission_courtier',
        'uuidClient',
        'uuidCompagnie',
        'uuidApporteur',
        'uuidBranche',
        'uuidContrat',
        'sync'
    ];

    // protected $casts = [
    //     'souscrit_le' => 'datetime:d/m/Y',
    //     'expire_le' => 'datetime:d/m/Y',
    // ];

    public function automobiles() {
        return $this->belongsToMany(Automobile::class,'automobile_contrats', 'id_automobile','id_contrat');
    }

    public function branche()
    {
        return $this->belongsTo(Branche::class, 'id_branche');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function apporteur()
    {
        return $this->belongsTo(Apporteur::class, 'id_apporteur');
    }

    public function compagnie()
    {
        return $this->belongsTo(Compagnie::class, 'id_compagnie');
    }
    public function scopeNonSupprimes($query)
    {
        return $query->where('supprimer_contrat', '=', '0');
    }

    public function scopeSolde($query)
    {
        return $query->where('solde', '=', '1');
    }

    public function scopeNonSolde($query)
    {
        return $query->where('solde', '=', '0');
    }

    public function scopeReverse($query)
    {
        return $query->where('reverse', '=', '1');
    }

    public function scopeNonReverse($query)
    {
        return $query->where('reverse', '=', '0');
    }
}
