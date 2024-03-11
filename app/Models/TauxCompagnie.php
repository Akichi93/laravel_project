<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TauxCompagnie extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tauxcomp';

    protected $fillable = [
        'id_compagnie',
        'id_branche',
        'tauxcomp',
        'uuidTauxCompagnie',
        'sync',
        'uuidCompagnie',
        'uuidBranche',
        'id_entreprise'
    ];

    protected $casts = [
        'tauxcomp' => 'float',
    ];
}
