<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apporteur extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_apporteur';

    protected $fillable = [
        'nom_apporteur',
        'email_apporteur',
        'contact_apporteur',
        'adresse_apporteur',
        'code_apporteur',
        'code_postal',
        'id_entreprise',
        'user_id',
        'sync',
        'uuidApporteur',
        'supprimer_apporteur',
    ];


    public function contrats()
    {
        return $this->hasMany(Contrat::class, 'id_apporteur');
    }
    
}
