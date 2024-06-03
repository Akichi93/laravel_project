<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    protected $fillable = [
        'classe',
        'uuidActivite',
        'activite',
        'id_entreprise',
        'user_id',    
        'sync',
    ];
}
