<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TauxApporteur extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tauxapp';

    protected $fillable = [
        'id_apporteur',
        'id_branche',
        'taux',
        'uuidApporteur',
        'uuidTauxApporteur',
        'uuidBranche',
        'id_entreprise',
        'sync',
    ];
}
