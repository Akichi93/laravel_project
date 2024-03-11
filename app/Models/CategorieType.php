<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieType extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_catype';

    protected $fillable = [
        'id_catdep',
        'id_typedep',
    ];
}
