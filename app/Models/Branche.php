<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branche extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_branche';

    protected $fillable = [
        'nom_branche',
        'id_entreprise',
        'user_id',
    ];
}
