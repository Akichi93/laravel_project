<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssuranceTemporaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuidAssuranceTemporaire',
        'uuidCompagnie',
        'nbreMoisMin',
        'nbreMoisMax',
        'pourcentage',
        'id_entreprise',
        'id_compagnie',
        'user_id',    
        'sync',
    ];
}
