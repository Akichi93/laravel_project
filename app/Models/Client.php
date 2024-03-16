<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_client';

    protected $fillable = [
        'civilite',
        'nom_client',
        'prenom_client',
        'postal_client',
        'adresse_client',
        'tel_client',
        'profession_client',
        'fax_client',
        'numero_client',
        'email_client',
        'id_entreprise',
        'user_id',
        'uuidClient',
        'sync',
    ];

    public function relances() {
        return $this->belongsToMany(Relance::class,'client_relance', 'id_relance','id_client');
    }

    public function contrats()
    {
        return $this->hasMany(Contrat::class, 'id_client');
    }
}
