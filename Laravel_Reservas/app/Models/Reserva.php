<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $with = ['user', 'tipo', 'salaZoom'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tipo(){
        return $this->belongsTo(Tipo::class);
    }

    public function salaZoom(){
        return $this->belongsTo(SalaZoom::class);
    }

}
