<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    protected $fillable = [ 'nom' ,'email' ,'telephone' ,'ville' ,'adress','RDV1' ,'relance1','Dialog'
    ,'RDV2' ,'relance2','Compte-Rendu2','RDV3' ,'relance3','Compte-Rendu3','RDV4' ,'relance4','Compte-Rendu4','prix'
];
}
