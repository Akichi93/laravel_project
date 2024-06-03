<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarificationAccident extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuidTarificateurAccident',
        'uuidActivite',
        'uuidCompagnie',
        'tauxDeces',
        'tauxIPT',
        'cent',
        'deuxCent',
        'quatreCent',
        'cinqCent',
        'id_activite',
        'id_entreprise',
        'user_id',
        'id_compagnie',
        'user_id',    
        'sync',
    ];
}
