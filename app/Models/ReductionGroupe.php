<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReductionGroupe extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuidReductionGroupe',
        'uuidCompagnie',
        'nbrePersonneMin',
        'nbrePersonneMax',
        'pourcentage',
        'id_entreprise',
        'id_compagnie',
        'user_id',    
        'sync',
    ];
}
