<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'equip_id', 'posicio', 'foto'];
    protected $table = 'jugadors';

    public function equip()
    {
        return $this->belongsTo(Equip::class);
    }

    public function __toString()
    {
        return $this->nom;
    }
}

