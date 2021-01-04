<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;
    protected $table = 'abonnement';
    protected $fillable = ['fk_profil', 'fk_profilsuivi'];
}
