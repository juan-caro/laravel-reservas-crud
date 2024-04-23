<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaZoom extends Model
{
    use HasFactory;

    protected $table = 'salas_zoom';

    public function reserva(){
        return $this->has(Reserva::class);
    }
}
