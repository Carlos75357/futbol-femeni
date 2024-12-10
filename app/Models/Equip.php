<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equip extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'estadi_id', 'titols', 'escut'];

    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }

    public function jugadores()
    {
        return $this->hasMany(Jugador::class);
    }

    public function equipLocal()
    {
        return $this->belongsTo(Equip::class, 'equip_local_id');
    }

    public function equipVisitant()
    {
        return $this->belongsTo(Equip::class, 'equip_visitant_id');
    }
}
