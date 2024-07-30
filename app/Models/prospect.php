<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prospect extends Model
{
    protected $fillable = [ 'nom' ,'nature de projet','source','email' ,'telephone' ,'ville' ,'adress','RDV' ,'relance','plan','Compte-Rendu'];
    protected $casts = [
        'plan' => 'array',
    ];
}
