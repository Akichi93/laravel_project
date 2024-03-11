<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compagnie extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_compagnie';

    protected $fillable = [
        'nom_compagnie',
        'adresse_compagnie',
        'email_compagnie',
        'contact_compagnie',
        'postal_compagnie',       
        'id_entreprise',       
        'user_id',       
        'code_compagnie',       
        'uuidCompagnie',      
        'sync',      
    ];

    public function contrats()
    {
        return $this->hasMany(Contrat::class, 'id_compagnie');
    }
}
