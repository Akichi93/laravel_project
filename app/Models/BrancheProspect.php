<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrancheProspect extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_prosbranche';

    protected $fillable = [
        'id_prospect',
        'id_branche',
        'description',
    ];
}
