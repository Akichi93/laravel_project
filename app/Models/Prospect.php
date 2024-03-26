<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_prospect';

    protected $fillable = [
        'uuidProspect',
        'id_entreprise',
        'nom_prospect',
        'adresse_prospect',
        'postal_prospect',
        'profession_prospect',
        'tel_prospect',
        'civilite',
        'email_prospect',
        'fax_prospect',
        'user_id',
        'sync',
        'etat',
        'statut',
    ];
}
